<?php
namespace Office365\PHP\Client\Runtime\Auth;



use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use Office365\PHP\Client\Runtime\Utilities\UserCredentials;

require_once(__DIR__ . '/../Utilities/Requests.php');
require_once('BaseTokenProvider.php');
require_once('SamlTokenProvider.php');
require_once('OAuthTokenProvider.php');
require_once('IAuthenticationContext.php');


/**
 * Authentication context for SharePoint Online/One Drive for Business.
 *
 */
class AuthenticationContext implements IAuthenticationContext
{
    /**
     * @var BaseTokenProvider
     */
    private $provider;

    /**
     * @var string
     */
    private $authorityUrl;


    /**
     * AuthenticationContext constructor.
     * @param string $authorityUrl
     */
	public function __construct($authorityUrl)
    {
        $this->authorityUrl = $authorityUrl;
    }


    /**
     * Acquire security token from STS
     * @param string $username
     * @param string $password
     */
	public function acquireTokenForUser($username,$password)
	{
        $this->provider = new SamlTokenProvider($this->authorityUrl);
        $parameters = array(
          'username' => $username,
          'password' => $password
        );
        $this->provider->acquireToken($parameters);
	}


    /**
     * @param string $resource
     * @param string $clientId
     * @param string $clientSecret
     */
    public function acquireTokenForClientCredential($resource,$clientId, $clientSecret)
    {
        $this->provider = new OAuthTokenProvider($this->authorityUrl);
        $parameters = array(
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'scope' => $resource,
            'resource' => $resource
        );
        $this->provider->acquireToken($parameters);
    }


    /**
     * @param string $resource
     * @param string $clientId
     * @param UserCredentials $credentials
     */
    public function acquireTokenForUserCredential($resource, $clientId, $credentials)
    {
        $this->provider = new OAuthTokenProvider($this->authorityUrl);
        $parameters = array(
            'grant_type' => 'password',
            'client_id' => $clientId,
            'username' => $credentials->Username,
            'password' => $credentials->Password,
            'scope' => 'openid',
            'resource' => $resource
        );
        $this->provider->acquireToken($parameters);
    }

    public function authenticateRequest(RequestOptions $options)
    {
        if($this->provider instanceof SamlTokenProvider)
            $options->addCustomHeader('Cookie',$this->provider->getAuthenticationCookie());
        elseif ($this->provider instanceof ACSTokenProvider
            || $this->provider instanceof OAuthTokenProvider)
            $options->addCustomHeader('Authorization',$this->provider->getAuthorizationHeader());
        else
            throw new \Exception("Unknown authentication provider");
    }

}