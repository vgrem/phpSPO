<?php
namespace SharePoint\PHP\Client;

require_once(__DIR__.'/../Utilities/Requests.php');


/**
 * AuthenticationContext short summary.
 *
 */
class AuthenticationContext
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
	 * SPO Auth cookie
	 * @var mixed
	 */
    private $FedAuth;

    /**
	 * SPO Auth cookie
	 * @var mixed
	 */
    private $rtFa;


	public function __construct($url)
    {
        $this->url = $url;
    }


    public function getAuthenticationCookie()
    {
        return 'FedAuth=' . $this->FedAuth . '; rtFa=' . $this->rtFa;
    }

    


	public function acquireTokenForUser($username,$password)
	{
		$token = $this->acquireToken($username, $password);
        $this->acquireAuthenticationCookies($token);
        #$contextInfo = $this->requestContextInfo();
        #$this->saveFormDigest($contextInfo);
	}


	/**
	 * Acquire SharePoint Online authentication (FedAuth and rtFa) cookies
	 * @param mixed $token
	 * @throws Exception
	 */
    protected function acquireAuthenticationCookies($token)
    {
        $urlinfo = parse_url($this->url);
        $url =  $urlinfo['scheme'] . '://' . $urlinfo['host'] . self::$signInPageUrl;
		$result = Requests::post($url,null,$token,$passHeaders = true);
        $cookies = Requests::parseCookies($result);
        $this->FedAuth = $cookies['FedAuth'];
        $this->rtFa = $cookies['rtFa'];
    }





	/**
	 * Acquire the service token from STS
	 *
	 * @param string $username
	 * @param string $password
	 * @return string
	 * @throws Exception
	 */
    protected function acquireToken($username, $password)
    {
        $saml = $this->prepareSamlTemplate($username, $password, $this->url);
		$result = Requests::post(self::$stsUrl,null,$saml);
        return $this->processToken($result);
    }


	/**
	 * Verify and extract security token from the HTTP response
	 * @param mixed $body
	 * @return mixed
	 */
    protected function processToken($body)
    {
        $xml = new \DOMDocument();
        $xml->loadXML($body);
        $xpath = new \DOMXPath($xml);
        if ($xpath->query("//S:Fault")->length > 0) {
            $nodeErr = $xpath->query("//S:Fault/S:Detail/psf:error/psf:internalerror/psf:text")->item(0);
            throw new \Exception($nodeErr->nodeValue);
        }
        $nodeToken = $xpath->query("//wsse:BinarySecurityToken")->item(0);
        if (empty($nodeToken)) {
            throw new \RuntimeException('Error trying to get a token, check your URL or credentials');
        }

        return $nodeToken->nodeValue;
    }

	/**
	 * Construct the SAML envelope to request security token from STS endpoint
	 *
	 * @param string $username
	 * @param string $password
	 * @param string $address
	 * @return type string
	 */
    protected function prepareSamlTemplate($username, $password, $address)
    {
        $samlXML = __DIR__ . '/xml/SAML.xml';
        if (!file_exists($samlXML)) {
            throw new \Exception("The file $samlXML does not exist");
        }

        $template = file_get_contents($samlXML);
        $template = str_replace('{username}', $username, $template);
        $template = str_replace('{password}', $password, $template);
        $template = str_replace('{address}', $address, $template);
        return $template;
    }

}