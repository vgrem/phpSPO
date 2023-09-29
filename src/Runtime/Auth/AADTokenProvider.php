<?php


namespace Office365\Runtime\Auth;

use Exception;
use Firebase\JWT\JWT;
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
    private static $TokenEndpointV2 = '/oauth2/v2.0/token';


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

    public function getTokenUrl($useV2){
        return $this->authorityUrl . ($useV2 ?  self::$TokenEndpointV2:  self::$TokenEndpoint);
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
     * @param CertificateCredentials $credentials
     * @throws Exception
     */
    public function acquireTokenForClientCertificate($credentials){
        $header = [
            'x5t' => base64_encode(hex2bin($credentials->Thumbprint)),
        ];
        $now = time();
        $payload = [
            'aud' => $this->getTokenUrl(true),
            'exp' => $now + 360,
            'iat' => $now,
            'iss' => $credentials->ClientId,
            'jti' => bin2hex(random_bytes(20)),
            'nbf' => $now,
            'sub' => $credentials->ClientId,
        ];
        $jwt = JWT::encode($payload, str_replace('\n', "\n", $credentials->PrivateKey), 'RS256', null, $header);

        $params['client_assertion_type'] = 'urn:ietf:params:oauth:client-assertion-type:jwt-bearer';
        $params['client_assertion'] = $jwt;
        $params['grant_type'] = "client_credentials";
        $params['scope'] = implode(" ", $credentials->Scope);

        return $this->acquireToken($params, true);
    }



    /**
     * @param string $resource
     * @param string $clientId
     * @param UserCredentials $userCredentials
     * 
     * @param FALSE|string $clientSecret
     * Use $clientSecret in case your app is a confidential client.
     * 
     * @throws Exception Resource owner password credential (ROPC) grant
     * (https://docs.microsoft.com/en-us/azure/active-directory/develop/v2-oauth-ropc)
     */
    public function acquireTokenForPassword($resource, $clientId, $userCredentials, $clientSecret = FALSE)
    {
        $parameters = array(
            'grant_type' => 'password',
            'client_id' => $clientId,
            'username' => $userCredentials->Username,
            'password' => $userCredentials->Password,
            'resource' => $resource
        );

        if($clientSecret) {
            $parameters += array('client_secret' => $clientSecret);
        }

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
     * @param bool $useV2
     * @return mixed
     * @throws Exception
     */
    public function acquireToken($parameters, $useV2=false)
    {
        $request = $this->prepareTokenRequest($parameters, $useV2);
        $response = Requests::execute($request);
        $response->validate();
        return $this->normalizeToken($response->getContent());
    }

    /**
     * @param array $parameters
     * @param bool $useV2
     * @return RequestOptions
     */
    private function prepareTokenRequest($parameters, $useV2)
    {
        $tokenUrl = $this->getTokenUrl($useV2);
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
        return json_decode($tokenValue,true);
    }
}
