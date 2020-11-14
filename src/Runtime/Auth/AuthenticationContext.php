<?php

namespace Office365\Runtime\Auth;


use Exception;
use Office365\Runtime\Http\RequestOptions;


/**
 * Authentication context for Azure AD STS
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
     * @var callable|null
     */
    private $acquireToken;

    /**
     * @var array
     */
    private $accessToken;

    /**
     * @var array
     */
    private $authCookies;


    /**
     * AuthenticationContext constructor.
     * @param string $authorityUrl
     * @param callable|null $acquireToken
     */
    public function __construct($authorityUrl, callable $acquireToken=null)
    {
        $this->authorityUrl = $authorityUrl;
        $this->acquireToken = $acquireToken;
    }

    /**
     * @var string
     */
    public function setAccessToken($value)
    {
        $this->accessToken = array("token_type" => "Bearer", "access_token" => $value);
    }


    /**
     * Acquire security token from STS
     * @param string $username
     * @param string $password
     * @throws Exception
     */
    public function acquireTokenForUser($username, $password)
    {
        $this->provider = new SamlTokenProvider($this->authorityUrl);
        $parameters = array(
            'username' => $username,
            'password' => $password
        );
        $this->accessToken = $this->provider->acquireToken($parameters);
    }


    /**
     * Acquire SharePoint App-Only via ACS
     * @param $clientId string
     * @param $clientSecret string
     * @throws Exception
     */
    public function acquireAppOnlyAccessToken($clientId, $clientSecret){
        $this->provider = new ACSTokenProvider($this->authorityUrl);
        $this->accessToken = $this->provider->acquireToken(array(
            "clientId" => $clientId,
            "clientSecret" => $clientSecret,
            "redirectUrl" => ""
        ));
    }


    /**
     * @param string $resource
     * @param ClientCredential $clientCredentials
     * @throws Exception
     */
    public function acquireTokenForClientCredential($resource, $clientCredentials)
    {
        $this->provider = new OAuthTokenProvider($this->authorityUrl);
        $parameters = array(
            'grant_type' => 'client_credentials',
            'client_id' => $clientCredentials->ClientId,
            'client_secret' => $clientCredentials->ClientSecret,
            #'scope' => $resource,
            'scope' => "https://outlook.office365.com/mail.read https://outlook.office365.com/mail.send",
            'resource' => $resource
        );
        $this->accessToken = $this->provider->acquireToken($parameters);
    }

    /**
     * @param string $resource
     * @param string $clientId
     * @param string $clientSecret
     * @param string $refreshToken
     * @param string $redirectUri
     * @throws Exception
     */
    public function acquireRefreshToken($resource, $clientId, $clientSecret, $refreshToken, $redirectUri)
    {
        $this->provider = new OAuthTokenProvider($this->authorityUrl);
        $parameters = array(
            'grant_type' => 'refresh_token',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'resource' => $resource,
            'redirect_uri' => $redirectUri,
            'refresh_token' => $refreshToken
        );
        $this->accessToken = $this->provider->acquireToken($parameters);
    }

    /**
     * @param string $resource
     * @param string $clientId
     * @param UserCredentials $userCredentials
     * @throws Exception Resource owner password credential (ROPC) grant (https://docs.microsoft.com/en-us/azure/active-directory/develop/v2-oauth-ropc)
     */
    public function acquireTokenForPassword($resource, $clientId, $userCredentials)
    {
        $this->provider = new OAuthTokenProvider($this->authorityUrl);
        $parameters = array(
            'grant_type' => 'password',
            'client_id' => $clientId,
            'username' => $userCredentials->Username,
            'password' => $userCredentials->Password,
            'resource' => $resource
        );
        $this->accessToken = $this->provider->acquireToken($parameters);
    }

    /**
     * @param string $uri
     * @param string $resource
     * @param string $clientId
     * @param string $clientSecret
     * @param string $code
     * @param string $redirectUrl
     * @throws Exception
     */
    public function acquireTokenByAuthorizationCode($uri,$resource, $clientId, $clientSecret, $code, $redirectUrl)
    {
        $this->provider = new OAuthTokenProvider($uri);
        $parameters = array(
            'grant_type' => 'authorization_code',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'code' => $code,
            'resource' => $resource,
            "redirect_uri" => $redirectUrl
        );
        $this->accessToken = $this->provider->acquireToken($parameters);
    }

    /**
     * @param RequestOptions $options
     * @throws Exception
     */
    public function authenticateRequest(RequestOptions $options)
    {
        if(is_callable($this->acquireToken) && is_null($this->accessToken)){
            call_user_func($this->acquireToken, $this);
            //ensure provider is initialized, otherwise set OAuthTokenProvider as default
            if(is_null($this->provider)){
                $this->provider = new OAuthTokenProvider($this->authorityUrl);
            }
        }

        if ($this->provider instanceof SamlTokenProvider) {
            if(is_null($this->authCookies)){
                $this->authCookies = $this->provider->acquireAuthenticationCookies($this->accessToken);
            }
            $this->ensureAuthenticationCookie($options);
        } elseif ($this->provider instanceof ACSTokenProvider || $this->provider instanceof OAuthTokenProvider) {
            $this->ensureAuthorizationHeader($options);
        } else {
            throw new Exception("Unknown token provider");
        }
    }

    /**
     * Ensures Authorization header is set
     * @param RequestOptions $options
     */
    protected function ensureAuthorizationHeader(RequestOptions $options)
    {
        $value = $this->accessToken['token_type'] . ' ' . $this->accessToken['access_token'];
        $options->ensureHeader('Authorization', $value);
    }


    /**
     * @param RequestOptions $options
     * @throws Exception
     */
    protected function ensureAuthenticationCookie(RequestOptions $options)
    {
        $headerVal = http_build_query($this->authCookies,null, "; ");
        $options->ensureHeader('Cookie', urldecode($headerVal));
    }

}
