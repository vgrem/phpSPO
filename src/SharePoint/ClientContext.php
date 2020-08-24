<?php

namespace Office365\SharePoint;

use Exception;
use Office365\Runtime\Auth\AuthenticationContext;
use Office365\Runtime\Auth\ClientCredential;
use Office365\Runtime\Auth\IAuthenticationContext;
use Office365\Runtime\Auth\UserCredentials;
use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\Http\HttpMethod;
use Office365\Runtime\OData\ODataRequest;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\Actions\UpdateEntityQuery;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\OData\JsonLightFormat;
use Office365\Runtime\OData\ODataMetadataLevel;
use Office365\Runtime\Http\RequestOptions;

/**
 * Client context for SharePoint API service
 */
class ClientContext extends ClientRuntimeContext
{
    /**
     * @var Site
     */
    private $site;

    /**
     * @var Web
     */
    private $web;

    /**
     * @var ContextWebInformation
     */
    private $contextWebInformation;

    /**
     * @var ODataRequest
     */
    private $pendingRequest;

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * ClientContext constructor.
     * @param string $url Site or Web url
     * @param IAuthenticationContext $authCtx
     */
    public function __construct($url, IAuthenticationContext $authCtx=null)
    {
        $this->baseUrl = $url;
        $this->getPendingRequest()->beforeExecuteRequest(function (RequestOptions $request) {
            $this->buildSharePointSpecificRequest($request);
        });
        parent::__construct($authCtx);
    }


    /**
     * Initializes SharePoint context from absolute Url
     * @param string $absUrl
     * @return ClientContext
     */
    public static function fromUrl($absUrl){
        $urlInfo = parse_url($absUrl);
        $rootSiteUrl =  $urlInfo['scheme'] . '://' . $urlInfo['host'];
        $ctx = new ClientContext($rootSiteUrl);
        $result = Web::getWebUrlFromPageUrl($ctx, $absUrl);
        $ctx->getPendingRequest()->afterExecuteRequest(function () use($ctx, $result){
            $ctx->baseUrl = $result->getValue();
        });
        return $ctx;
    }

    /**
     * @return ODataRequest
     */
    public function getPendingRequest()
    {
        if (!isset($this->pendingRequest)) {
            $this->pendingRequest = new ODataRequest($this,new JsonLightFormat(ODataMetadataLevel::Verbose));
        }
        return $this->pendingRequest;
    }

    /**
     * Creates authenticated SharePoint context via user or client credentials
     * @param ClientCredential|UserCredentials $credential
     * @return ClientContext
     */
    public function withCredentials($credential)
    {
        $this->authContext = new AuthenticationContext($this->baseUrl,function (AuthenticationContext  $authCtx) use($credential) {
            if ($credential instanceof UserCredentials)
                $authCtx->acquireTokenForUser($credential->Username, $credential->Password);
            elseif ($credential instanceof ClientCredential)
                $authCtx->acquireAppOnlyAccessToken($credential->ClientId, $credential->ClientSecret);
            else
                throw new Exception("Unknown credentials");
        });
        return $this;
    }


    /**
     * Status: deprecated, prefer nowadays WithCredentials method
     * @param string $url
     * @param string $username
     * @param string $password
     * @return ClientContext
     * @throws Exception
     */
    public static function connectWithUserCredentials($url,$username,$password)
    {
        $authContext = new AuthenticationContext($url);
        $authContext->acquireTokenForUser($username, $password);
        return new ClientContext($url,$authContext);
    }


    /**
     * @param string $url
     * @param string $clientId
     * @param string $clientSecret
     * @return ClientContext
     * @throws Exception
     */
    public static function connectWithClientCredentials($url, $clientId, $clientSecret)
    {
        $authCtx = new AuthenticationContext($url);
        $authCtx->acquireAppOnlyAccessToken($clientId,$clientSecret);
        return new ClientContext($url,$authCtx);
    }

    /**
     * Ensure form digest value for POST request
     * @param RequestOptions $request
     */
    public function ensureFormDigest(RequestOptions $request)
    {
        if (!isset($this->contextWebInformation)) {
            $this->requestFormDigest();
        }
        $request->ensureHeader("X-RequestDigest",$this->getContextWebInformation()->FormDigestValue);
    }

    /**
     * Request the SharePoint Context Info
     * @throws Exception
     */
    public function requestFormDigest()
    {
        $request = new RequestOptions($this->getServiceRootUrl() . "contextinfo");
        $request->Method = HttpMethod::Post;
        $response = $this->executeQueryDirect($request);
        if(!isset($this->contextWebInformation))
            $this->contextWebInformation = new ContextWebInformation();
        $format = new JsonLightFormat();
        $format->FunctionTag = "GetContextWebInformation";
        $payload = json_decode($response->getContent(), true);
        $this->getPendingRequest()->mapJson($payload,$this->contextWebInformation, $format);
    }


    /**
     * @param RequestOptions $request
     */
    private function buildSharePointSpecificRequest(RequestOptions $request){

        $query = $this->getCurrentQuery();
        if($request->Method === HttpMethod::Post) {
            $this->ensureFormDigest($request);
        }

        //set data modification headers
        if ($query instanceof UpdateEntityQuery) {
            $request->ensureHeader("IF-MATCH", "*");
            $request->ensureHeader("X-HTTP-Method", "MERGE");
        } else if ($query instanceof DeleteEntityQuery) {
            $request->ensureHeader("IF-MATCH", "*");
            $request->ensureHeader("X-HTTP-Method", "DELETE");
        }
    }

    /**
     * @return Web
     */
    public function getWeb()
    {
        if(!isset($this->web)){
            $this->web = new Web($this,new ResourcePath("Web"));
        }
        return $this->web;
    }

    /**
     * @return Site
     */
    public function getSite()
    {
        if(!isset($this->site)){
            $this->site = new Site($this, new ResourcePath("Site"));
        }
        return $this->site;
    }

    /**
     * @return ContextWebInformation
     */
    public function getContextWebInformation()
    {
        return $this->contextWebInformation;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param string $value
     */
    public function setBaseUrl($value)
    {
        $this->baseUrl = $value;
    }

    /**
     * @return string
     */
    public function getServiceRootUrl()
    {
        return  "{$this->getBaseUrl()}/_api/";
    }


    /**
     * @return RequestOptions
     */
    public function buildRequest()
    {
        $request = parent::buildRequest();
        $this->buildSharePointSpecificRequest($request);
        return $request;
    }
}
