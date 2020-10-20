<?php


namespace Office365\Runtime\Auth;


use DOMDocument;
use DOMNode;
use DOMNodeList;
use DOMXPath;
use Exception;
use Office365\Runtime\Http\Requests;
use Office365\Runtime\Http\Response;
use RuntimeException;

class SamlTokenProvider extends BaseTokenProvider
{

    /**
     * External Security Token Service
     * @var string
     */
    private static $StsUrl = 'https://login.microsoftonline.com/extSTS.srf';

    /**
     * RST2 URL
     * @var string
     */
    private static $RST2Url = 'https://login.microsoftonline.com/rst2.srf';

    /**
     * To Get the STS authentication url if $StsUrl request fails.
     * @var string
     */
    private static $RealmUrlTemplate = 'https://login.microsoftonline.com/getuserrealm.srf?login={username}&xml=1';


    /**
     * Form Url to submit SAML token
     * @var string
     */
    private static $SignInPageUrl = '/_forms/default.aspx?wa=wsignin1.0';


    /**
     * Boolean to determine whether the system is using Federated STS or not.
     * @var
     */
    protected $useFederatedSTS;

    /**
     * Form Url to submit SAML token if Federated STS is set.
     * @var string
     */
    private static $IDCRLSVCPageUrl = '/_vti_bin/idcrl.svc/';


    /**
     * @var string
     */
    protected $authorityUrl;


    public function __construct($authorityUrl)
    {
        $this->authorityUrl = $authorityUrl;
        $this->useFederatedSTS = false;
    }


    /**
     * @param array $parameters
     * @return string
     * @throws Exception
     */
    public function acquireToken($parameters)
    {
        return $this->acquireSecurityToken($parameters['username'], $parameters['password']);
    }


    /**
     * Acquire SharePoint Online authentication cookies
     * @param mixed $token
     * @return array
     * @throws Exception
     */
    public function acquireAuthenticationCookies($token)
    {
        $hostInfo = parse_url($this->authorityUrl);
        $url =  $hostInfo['scheme'] . '://' . $hostInfo['host'] . self::$SignInPageUrl;
        if ($this->useFederatedSTS) {
            $url =  $hostInfo['scheme'] . '://' . $hostInfo['host'] . self::$IDCRLSVCPageUrl;

            $headers = array();
            $headers['User-Agent'] = '';
            $headers['X-IDCRL_ACCEPTED'] = 't';
            $headers['Authorization'] = 'BPOSIDCRL ' . $token;
            $headers['Content-Type'] = 'application/x-www-form-urlencoded';

            $response = Requests::head($url,$headers,true);
            return Requests::parseCookies($response->getContent());
        }
        else {
            $response = Requests::post($url,null,$token,true);
            return Requests::parseCookies($response->getContent());
        }
    }


    /**
     * Acquire the service token from STS
     *
     * @param string $username
     * @param string $password
     * @return string
     * @throws Exception
     */
    protected function acquireSecurityToken($username, $password)
    {
        $data = $this->prepareSecurityTokenRequest($username, $password, $this->authorityUrl);
        $response = Requests::post(self::$StsUrl, null, $data);

        try {
            return $this->processSecurityTokenResponse($response->getContent());
        } catch (Exception $e) {
            // Try to get the token with a federated authentication.
            $response = $this->acquireSecurityTokenFromFederatedSTS($username, $password);
            if(is_null($response))
                throw $e;
            return $this->processSecurityTokenResponse($response->getContent());
        }
    }

    /**
     * Acquire the service token from Federated STS
     *
     * @param string $username
     * @param string $password
     * @return Response
     * @throws Exception
     */
    protected function acquireSecurityTokenFromFederatedSTS($username, $password) {

        $response = Requests::get(str_replace('{username}', $username, self::$RealmUrlTemplate),null);
        $federatedStsUrl = $this->getFederatedAuthenticationInformation($response->getContent());

        if ($federatedStsUrl) {
          $message_id = md5(uniqid($username . '-' . time() . '-' . rand() , true));
          $data = $this->prepareSecurityFederatedTokenRequest($username, $password, $message_id, $federatedStsUrl->textContent);

          $headers = array();
          $headers['Content-Type'] = 'application/soap+xml';
          $response = Requests::post($federatedStsUrl->textContent, $headers, $data);

          $samlAssertion = $this->getSamlAssertion($response->getContent());

          if ($samlAssertion) {
            $samlAssertion_node = $samlAssertion->item(0);
            $data = $this->prepareRST2Request($samlAssertion_node);
            $response = Requests::post(self::$RST2Url, $headers, $data);
            $this->useFederatedSTS = TRUE;
            return $response;
          }
        }
        return null;
    }

    /**
     * Get SAML assertion Node so it can be used within the RST2 template
     * @param $payload
     * @return DOMNodeList|null
     */
    protected function getSamlAssertion($payload) {
      $xml = new DOMDocument();
      $xml->loadXML($payload);
      $xpath = new DOMXPath($xml);

      if ($xpath->query("//*[name()='saml:Assertion']")->length > 0) {
        $nodeToken = $xpath->query("//*[name()='saml:Assertion']");
        if (!empty($nodeToken)) {
          return $nodeToken;
        }
      }
      return null;
    }

    /**
     * Retrieves the STS federated URL if any.
     * @param $response
     * @return DOMNode|null Federated STS Url
     */
    protected function getFederatedAuthenticationInformation($response) {
        if ($response) {
            $xml = new DOMDocument();
            $xml->loadXML($response);
            $xpath = new DOMXPath($xml);
            if ($xpath->query("//STSAuthURL")->length > 0) {
                return $xpath->query("//STSAuthURL")->item(0);
            }
        }
        return null;
    }

    /**
     * Verify and extract security token from the HTTP response
     * @param mixed $payload
     * @return mixed BinarySecurityToken or Exception when an error is present
     * @throws Exception
     */
    protected function processSecurityTokenResponse($payload)
    {
        $xml = new DOMDocument();
        $xml->loadXML($payload);
        $xpath = new DOMXPath($xml);
        if ($xpath->query("//wsse:BinarySecurityToken")->length > 0) {
            $nodeToken = $xpath->query("//wsse:BinarySecurityToken")->item(0);
            if (!empty($nodeToken)) {
              return $nodeToken->nodeValue;
            }
        }

        if ($xpath->query("//S:Fault")->length > 0) {
            // Returning the full fault value in case any other response comes within the fault node.
            throw new RuntimeException($xpath->query("//S:Fault")->item(0)->nodeValue);
        }
        throw new RuntimeException('An error occurred while obtaining a token, check your URL or credentials');
    }

    /**
     * Construct the request body to acquire security token from STS endpoint
     *
     * @param string $username
     * @param string $password
     * @param string $address
     * @return string
     * @throws Exception
     */
    protected function prepareSecurityTokenRequest($username, $password, $address)
    {
        $fileName = __DIR__ . '/xml/SAML.xml';
        if (!file_exists($fileName)) {
            throw new Exception("The file $fileName does not exist");
        }

        $template = file_get_contents($fileName);
        $template = str_replace('{username}', $username, $template);
        $template = str_replace('{password}', $password, $template);
        $template = str_replace('{address}', $address, $template);
        return $template;
    }

    /**
     * Construct the request body to acquire security token from Federated STS endpoint (sts.yourcompany.com)
     *
     * @param string $username
     * @param string $password
     * @param string $message_uuid
     * @param string $federated_sts_url
     * @return string
     * @throws Exception
     */
    protected function prepareSecurityFederatedTokenRequest($username, $password, $message_uuid, $federated_sts_url)
    {
      $fileName = __DIR__ . '/xml/federatedSAML.xml';
      if (!file_exists($fileName)) {
        throw new Exception("The file $fileName does not exist");
      }

      $template = file_get_contents($fileName);
      $template = str_replace('{username}', $username, $template);
      $template = str_replace('{password}', $password, $template);
      $template = str_replace('{federated_sts_url}', $federated_sts_url, $template);
      $template = str_replace('{message_uuid}', $message_uuid, $template);
      return $template;
    }

    /**
     * Prepare the request to be sent to RST2 endpoint with the saml assertion
     * @param $samlAssertion
     * @return bool|mixed|string
     * @throws Exception
     */
    protected function prepareRST2Request($samlAssertion)
    {

      $fileName = __DIR__ . '/xml/RST2.xml';
      if (!file_exists($fileName)) {
        throw new Exception("The file $fileName does not exist");
      }
      $template = file_get_contents($fileName);

      $xml = new DOMDocument();
      $xml->loadXML($template);
      $xpath = new DOMXPath($xml);

      $samlAssertion = $xml->importNode($samlAssertion, true);
      if ($xpath->query("//*[name()='wsse:Security']")->length > 0) {
          $parentNode = $xpath->query("//wsse:Security")->item(0);
          //append "saml assertion" node to <wsse:Security> node
          $parentNode->appendChild($samlAssertion);
          return $xml->saveXML();
      }
      return NULL;
    }
}
