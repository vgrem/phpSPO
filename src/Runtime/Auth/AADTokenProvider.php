<?php


namespace Office365\Runtime\Auth;

use Exception;
use Office365\Runtime\Http\HttpMethod;
use Office365\Runtime\Http\RequestOptions;
use Office365\Runtime\Http\Requests;


/**
 * OAuth2 provider to acquire the access token from AAD
 */
class AADTokenProvider extends BaseTokenProvider
{

    /**
     * @var string
     */
    private static $TokenEndpoint = '/oauth2/token';

    /**
     * @var string
     */
    public static $AuthorityUrl = "https://login.microsoftonline.com/";


    /**
     * @var string
     */
    private static  $AuthorizeEndpoint = '/oauth2/authorize';


    /**
     * @var string
     */
    private $authorityUrl;

    /**
     * @param string $tenant
     */
    public function __construct($tenant)
    {
        $this->authorityUrl = self::$AuthorityUrl . $tenant;
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

        $parameters = array(
            'grant_type' => 'refresh_token',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'resource' => $resource,
            'redirect_uri' => $redirectUri,
            'refresh_token' => $refreshToken
        );
        return  $this->acquireToken($parameters);
    }


    /**
     * @param string $resource
     * @param ClientCredential $clientCredentials
     * @throws Exception
     */
    public function acquireTokenForClientCredential($resource, $clientCredentials, $scopes)
    {
        $parameters = array(
            'grant_type' => 'client_credentials',
            'client_id' => $clientCredentials->ClientId,
            'client_secret' => $clientCredentials->ClientSecret,
            'scope' => implode(" ", $scopes),
            'resource' => $resource
        );
        return $this->acquireToken($parameters);
    }


    /**
     * @param string $resource
     * @param string $clientId
     * @param UserCredentials $userCredentials
     * @throws Exception Resource owner password credential (ROPC) grant
     * (https://docs.microsoft.com/en-us/azure/active-directory/develop/v2-oauth-ropc)
     */
    public function acquireTokenForPassword($resource, $clientId, $userCredentials)
    {
        $parameters = array(
            'grant_type' => 'password',
            'client_id' => $clientId,
            'username' => $userCredentials->Username,
            'password' => $userCredentials->Password,
            'resource' => $resource
        );
        return $this->acquireToken($parameters);
    }


    /**
     * @param string $resource
     * @param string $clientId
     * @param string $clientSecret
     * @param string $code
     * @param string $redirectUrl
     * @throws Exception
     */
    public function acquireTokenByAuthorizationCode($resource, $clientId, $clientSecret, $code, $redirectUrl)
    {
        $parameters = array(
            'grant_type' => 'authorization_code',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'code' => $code,
            'resource' => $resource,
            "redirect_uri" => $redirectUrl
        );
        return $this->acquireToken($parameters);
    }

    /**
     * Acquires the access token
     * @param array $parameters
     * @return mixed
     * @throws Exception
     */
    public function acquireToken($parameters)
    {
        $request = $this->prepareTokenRequest($parameters);
        $response = Requests::execute($request);
        $response->validate();
        return $this->normalizeToken($response->getContent());
    }

    /**
     * @param $parameters
     * @return RequestOptions
     */
    private function prepareTokenRequest($parameters)
    {
        $tokenUrl = $this->authorityUrl . self::$TokenEndpoint;
        $request = new RequestOptions($tokenUrl);
        $request->ensureHeader('content-Type', 'application/x-www-form-urlencoded');
        $request->Method = HttpMethod::Post;
        $request->Data = http_build_query($parameters);
        return $request;
    }

    /**
     * Parse the id token that represents a JWT token that contains information about the user
     * @param string $tokenValue
     * @return mixed
     */
    private function normalizeToken($tokenValue)
    {
        $tokenPayload = json_decode($tokenValue,true);
        if (!is_null($tokenPayload)) {
            if (isset($tokenPayload['id_token'])) {
                $idToken = $tokenPayload['id_token'];
                $idTokenPayload = base64_decode(
                    explode('.', $idToken)[1]
                );
                $tokenPayload['id_token_info'] = json_decode($idTokenPayload, true);
            }
        }
        return $tokenPayload;
    }
}
