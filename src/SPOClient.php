<?php
namespace VGrem\phpSPO;

/**
 * SPO client
 */
class SPOClient
{

    /**
     * External Security Token Service for SPO
     * @var mixed
     */
    private static $stsUrl = 'https://login.microsoftonline.com/extSTS.srf';

    /**
     * Form Url to submit SAML token
     * @var string
     */
    private static $signInPageUrl = '/_forms/default.aspx?wa=wsignin1.0';

    /**
     * SharePoint Site url
     * @var string
     */
    public $url;

    /**
     * SPO Auth cookie
     * @var mixed
     */
    private $FedAuth;

    /**
     * SPO Auth cookie
     * @var mixed
     */
    private $rtFa;


    /**
     * Form Digest
     * @var string
     */
    public $formDigest;


    /**
     * Class constructor
     * @param string $url
     * @throws Exception
     */
    public function __construct($url)
    {
        if (!function_exists('curl_init')) {
            throw new \Exception('CURL module not available! SPOClient requires CURL. See http://php.net/manual/en/book.curl.php');
        }
        $this->url = $url;
    }

    /**
     * SPO sign-in
     * @param mixed $username
     * @param mixed $password
     */
    public function signIn($username, $password)
    {
        $token = $this->requestToken($username, $password);
        $header = $this->submitToken($token);
        $this->saveAuthCookies($header);
        $contextInfo = $this->requestContextInfo();
        $this->saveFormDigest($contextInfo);
    }


    public function getList($name)
    {
        $list = new SPList($this, $name);
        return $list;
    }


    /**
     * Request the SharePoint List data
     * @param mixed $options
     * @return mixed
     */
    public function requestList($options)
    {
        $url = $this->url . "/_api/web/Lists/getByTitle('" . $options['list'] . "')/items";
        if (array_key_exists('id', $options)) {
            $url = $url . "(" . $options['id'] . ")";
        }

        $options['url'] = $url;
        return $this->request($options);
    }

    /**
     * Request the Context Info
     * @return mixed
     */
    private function requestContextInfo()
    {
        $options = array(
         'url' => $this->url . "/_api/contextinfo",
         'method' => 'POST'
        );

        $data = $this->request($options, false);
        return $data->d->GetContextWebInformation;
    }

    /**
     * Save the SPO Form Digest
     * @param mixed $contextInfo
     */
    private function saveFormDigest($contextInfo)
    {
        $this->formDigest = $contextInfo->FormDigestValue;
    }


    /**
     * Request the SharePoint REST endpoint
     * @param mixed $options
     * @throws Exception
     * @return mixed
     */
    public function request($options, $pass_form_digest = true)
    {
        $data = array_key_exists('data', $options) ? json_encode($options['data']) : '';
        $headers = array(
            'Accept: application/json; odata=verbose',
            'Content-type: application/json; odata=verbose',
            'Cookie: FedAuth=' . $this->FedAuth . '; rtFa=' . $this->rtFa,
            'Content-length:' . strlen($data)
        );
        // Include If-Match header if etag is specified
        if (array_key_exists('etag', $options)) {
            $headers[] = 'If-Match: ' . $options['etag'];
        }
        // Include X-RequestDigest header if formdigest is specified
        if (array_key_exists('formdigest', $options)) {
            $headers[] = 'X-RequestDigest: ' . $options['formdigest'];
        } elseif ($pass_form_digest == true && ($options['method'] == 'POST' ||$options['method'] == 'DELETE')) {
            $contextInfo = $this->requestContextInfo();
            $headers[] = 'X-RequestDigest: ' . $contextInfo->FormDigestValue;
        }
        // Include X-Http-Method header if xhttpmethod is specified
        if (array_key_exists('xhttpmethod', $options)) {
            $headers[] = 'X-Http-Method: ' . $options['xhttpmethod'];
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $options['url']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if ($options['method'] != 'GET') {
            curl_setopt($ch, CURLOPT_POST, 1);
            if (array_key_exists('data', $options)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        if ($result === false) {
            throw new \Exception(curl_error($ch));
        }

        curl_close($ch);
        return json_decode($result);
    }




    /**
     * Get the FedAuth and rtFa cookies
     * @param mixed $token
     * @throws Exception
     */
    private function submitToken($token)
    {

        $urlinfo = parse_url($this->url);
        $url =  $urlinfo['scheme'] . '://' . $urlinfo['host'] . self::$signInPageUrl;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        $result = curl_exec($ch);
        if ($result === false) {
            throw new \Exception(curl_error($ch));
        }
        $header=substr($result, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
        curl_close($ch);

        return $header;
    }

    /**
     * Save the SPO auth cookies
     * @param mixed $header
     */
    private function saveAuthCookies($header)
    {
        $cookies = HttpUtilities::cookieParse($header);
        $this->FedAuth = $cookies['FedAuth'];
        $this->rtFa = $cookies['rtFa'];
    }


    /**
     * Request the token
     *
     * @param string $username
     * @param string $password
     * @return string
     * @throws Exception
     */
    private function requestToken($username, $password)
    {

        $samlRequest = $this->buildSamlRequest($username, $password, $this->url);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, self::$stsUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $samlRequest);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        if ($result === false) {
            throw new \Exception(curl_error($ch));
        }
        curl_close($ch);
        return $this->processToken($result);
    }




    /**
     * Verify and extract security token from the HTTP response
     * @param mixed $body
     * @return mixed
     */
    private function processToken($body)
    {
        $xml = new \DOMDocument();
        $xml->loadXML($body);
        $xpath = new \DOMXPath($xml);
        if ($xpath->query("//S:Fault")->length > 0) {
            $nodeErr = $xpath->query("//S:Fault/S:Detail/psf:error/psf:internalerror/psf:text")->item(0);
            throw new \Exception($nodeErr->nodeValue);
        }
        $nodeToken = $xpath->query("//wsse:BinarySecurityToken")->item(0);
        return $nodeToken->nodeValue;
    }

    /**
     * Construct the XML to request the security token
     *
     * @param string $username
     * @param string $password
     * @param string $address
     * @return type string
     */
    private function buildSamlRequest($username, $password, $address)
    {
        $samlRequestTemplate = file_get_contents(__DIR__ . '../xml/SAML.xml');
        $samlRequestTemplate = str_replace('{username}', $username, $samlRequestTemplate);
        $samlRequestTemplate = str_replace('{password}', $password, $samlRequestTemplate);
        $samlRequestTemplate = str_replace('{address}', $address, $samlRequestTemplate);
        return $samlRequestTemplate;
    }
}
