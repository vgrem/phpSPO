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

    public function getAuthenticationCookie()
    {
        return $this->provider->getAuthenticationCookie();
    }

	public function acquireTokenForUser($username,$password)
	{
        $this->provider = new SamlTokenProvider($this->url,$username,$password);
        $this->provider->acquireToken();
	}




}