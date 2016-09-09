<?php


namespace Office365\PHP\Client\Runtime\Auth;
use Office365\PHP\Client\Runtime\HttpMethod;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use Office365\PHP\Client\Runtime\Utilities\Requests;

/**
 * Provider to acquire the access token from Azure AD
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
    public static  $AuthorityUrl = "https://login.microsoftonline.com/";


    /**
     * @var string
     */
    //private static  $AuthorizeEndpoint = '/oauth2/authorize';

    /**
     * @var string
     */
    public static $ResourceId = 'https://outlook.office365.com/';
    //private static $ResourceId = 'https://graph.windows.net/';


    /**
     * @var string
     */
    private $authorityUrl;


    /**
     * @var string
     */
    //private $redirectUrl;

    /**
     * @var \stdClass
     */
    private $accessToken;


    public function __construct($authorityUrl)
    {
        $this->authorityUrl = $authorityUrl;
    }

    public function getAuthorizationHeader()
    {
        return 'Bearer ' . $this->accessToken->access_token;
    }

    /**
     * Acquires the access token
     * @param array $parameters
     */
    public function acquireToken($parameters)
    {
        $request = $this->createRequest($parameters);
        $response = Requests::execute($request);
        $jsonResponse = json_decode($response);
        $this->accessToken = $jsonResponse;
    }


    /**
     * @param $parameters
     * @return RequestOptions
     */
    private function createRequest($parameters){
        $tokenUrl = $this->authorityUrl . self::$TokenEndpoint;
        $request = new RequestOptions($tokenUrl);
        $request->addCustomHeader('Content-Type', 'application/x-www-form-urlencoded');
        $request->Method = HttpMethod::Post;
        $request->Data = http_build_query($parameters);
        return $request;
    }
}