<?php

namespace Office365\Runtime\Auth;


use Exception;
use Office365\Runtime\Http\RequestOptions;


/**
 * SharePoint specific authentication context
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
     */
    public function __construct($authorityUrl)
    {
        $this->authorityUrl = $authorityUrl;
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
     * @param RequestOptions $request
     * @throws Exception
     */
    public function authenticateRequest(RequestOptions $request)
    {
        if ($this->provider instanceof SamlTokenProvider) {
            if(is_null($this->authCookies)){
                $this->authCookies = $this->provider->acquireAuthenticationCookies($this->accessToken);
            }
            $this->ensureAuthenticationCookie($request);
        } elseif ($this->provider instanceof ACSTokenProvider || $this->provider instanceof OAuthTokenProvider) {
            $this->ensureAuthorizationHeader($request);
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
        //$value = $this->accessToken['token_type'] . ' ' . $this->accessToken['access_token'];
        $value = "Bearer " . $this->accessToken["access_token"];
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
