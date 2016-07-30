<?php
namespace SharePoint\PHP\Client;



require_once(__DIR__ . '/../utilities/Requests.php');
require_once('BaseTokenProvider.php');
require_once('SamlTokenProvider.php');
require_once('OAuthTokenProvider.php');


/**
 * Authentication context for Office 365.
 *
 */
class AuthenticationContext
{
    /**
     * @var BaseTokenProvider
     */
    private $provider;

	public function __construct($url)
    {
        $this->url = $url;
    }


	public function acquireTokenForUser($username,$password)
	{
        $this->provider = new SamlTokenProvider($this->url,$username,$password);
        $this->provider->acquireToken();
	}


    public function acquireTokenForApp($clientId,$clientSecret,$redirectUrl)
    {
        $this->provider = new OAuthTokenProvider($this->url,$clientId,$clientSecret,$redirectUrl);
        $this->provider->acquireToken();
    }

    public function authenticateRequest(RequestOptions &$options)
    {
        if($this->provider instanceof SamlTokenProvider)
            $options->addCustomHeader('Cookie',$this->provider->getAuthenticationCookie());
        elseif ($this->provider instanceof OAuthTokenProvider)
            $options->addCustomHeader('Authorization',$this->provider->getAuthorizationHeader());
        else
            throw new \Exception("Unknown authentication provider");
    }

}