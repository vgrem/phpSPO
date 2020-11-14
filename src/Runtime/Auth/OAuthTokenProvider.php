<?php


namespace Office365\Runtime\Auth;

use Exception;
use Office365\Runtime\Http\HttpMethod;
use Office365\Runtime\Http\RequestOptions;
use Office365\Runtime\Http\Requests;


/**
 * OAuth2 provider to acquire the access token from AAD
 */
class OAuthTokenProvider extends BaseTokenProvider
{

    /**
     * @var string
     */
    private static $TokenEndpoint = '/oauth2/token';

    /**
     * @var string
     */
    //private static $AuthorityUrl  = 'https://login.microsoftonline.com/common';
    public static $AuthorityUrl = "https://login.microsoftonline.com/";


    /**
     * @var string
     */
    //private static  $AuthorizeEndpoint = '/oauth2/authorize';

    /**
     * @var string
     */
    //public static $ResourceId = 'https://outlook.office365.com/';
    //private static $ResourceId = 'https://graph.windows.com/';

    /**
     * @var string
     */
    private $authorityUrl;

    /**
     * @param string $authorityUrl
     */
    public function __construct($authorityUrl)
    {
        $this->authorityUrl = $authorityUrl;
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
