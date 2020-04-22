<?php


namespace Office365\Runtime\Auth;
use Office365\Runtime\Http\RequestException;
use Office365\Runtime\Http\Requests;

/**
 * Provider to acquire the access token from a Microsoft Azure Access Control Service (ACS)
 */
class ACSTokenProvider extends BaseTokenProvider
{

    /**
     * @var string
     */
    private static $SharePointPrincipal = "00000003-0000-0ff1-ce00-000000000000";

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var string
     */
    private $redirectUrl;

    /**
     * @var array
     */
    private $accessToken;


    public function __construct($url,$clientId, $clientSecret,$redirectUrl)
    {
        $this->url = $url;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * Generate Authorization header
     * @return string
     */
    public function getAuthorizationHeader()
    {
        return 'Bearer ' . $this->accessToken['access_token'];
    }


    /**
     * Acquires the access token from a Microsoft Azure Access Control Service (ACS)
     * @param array $parameters
     * @throws RequestException
     */
    public function acquireToken($parameters)
    {
        $realm = $this->getRealmFromTargetUrl();
        $urlInfo = parse_url($this->url);
        $this->accessToken = $this->getAppOnlyAccessToken($urlInfo["host"],$realm);
    }


    /**
     * @return mixed
     */
    private function getRealmFromTargetUrl()
    {
        $headers = array();
        $headers['Authorization'] = 'Bearer';
        $response = Requests::head($this->url, $headers);
        return $this->processRealmResponse($response->getContent());
    }


    private function processRealmResponse($payload){
        $headerKey = "WWW-Authenticate";
        $result = array_filter(
            explode("\r\n", $payload),
            function ($line) use ($headerKey) {
                return stripos($line,$headerKey) === 0;
            }
        );

        if(count($result) > 0){
            $authHeader = explode(",", reset($result));
            $bearerHeader = explode(':', $authHeader[0]);
            $realm = explode('=', $bearerHeader[1]);
            return str_replace('"', '', $realm[1]);
        }
        return null;
    }


    /**
     * Obtain access token from Azure ACS
     * @param string $targetHost
     * @param string $targetRealm
     * @return mixed
     * @throws RequestException
     */
    private function getAppOnlyAccessToken($targetHost,$targetRealm)
    {
        $resource = $this->getFormattedPrincipal(self::$SharePointPrincipal,$targetHost,$targetRealm);
        $clientId = $this->getFormattedPrincipal($this->clientId,null, $targetRealm);
        $stsUrl = $this->getSecurityTokenServiceUrl($targetRealm);
        $oauth2Request = $this->createAccessTokenRequestWithClientCredentials($clientId,$this->clientSecret,$resource);

        $headers = array();
        $headers[] = 'content-Type: application/x-www-form-urlencoded';
        $response = Requests::post($stsUrl, $headers, $oauth2Request);
        return json_decode($response->getContent(),true);
    }


    private function getFormattedPrincipal($principalName, $hostName, $realm)
    {
        if ($hostName) {
            return "$principalName/$hostName@$realm";
        }
        return "$principalName@$realm";
    }

    private function getSecurityTokenServiceUrl($realm){
        return "https://accounts.accesscontrol.windows.net/$realm/tokens/OAuth/2";
    }

    private function createAccessTokenRequestWithClientCredentials($clientId, $clientSecret, $scope)
    {
        $data = array(
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'scope' => $scope,
            'resource' => $scope
        );
        return http_build_query($data);
    }
}
