<?php

namespace Office365\PHP\Client\SharePoint;

use Exception;
use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\Auth\IAuthenticationContext;
use Office365\PHP\Client\Runtime\ClientAction;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\Http\HttpMethod;
use Office365\PHP\Client\Runtime\OData\ODataRequest;
use Office365\PHP\Client\Runtime\ResourcePath;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\OData\JsonLightFormat;
use Office365\PHP\Client\Runtime\OData\ODataMetadataLevel;
use Office365\PHP\Client\Runtime\Http\RequestOptions;

/**
 * Client context for SharePoint REST/OData service
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
     * ClientContext constructor.
     * @param string $serviceUrl
     * @param IAuthenticationContext $authCtx
     */
    public function __construct($serviceUrl, IAuthenticationContext $authCtx)
    {
        $serviceRootUrl = $serviceUrl . '/_api/';
        parent::__construct($serviceRootUrl,$authCtx);
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
     * @param string $url
     * @param string $username
     * @param string $password
     * @return ClientContext
     * @throws Exception
     */
    public static function connectWithUserCredentials($url,$username,$password)
    {
        $authCtx = new AuthenticationContext($url);
        $authCtx->acquireTokenForUser($username,$password);
        return new ClientContext($url,$authCtx);
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
     * @throws Exception
     */
    public function ensureFormDigest(RequestOptions $request)
    {
        if (!isset($this->contextWebInformation)) {
            $this->requestFormDigest();
        }
        $request->addCustomHeader("X-RequestDigest",$this->getContextWebInformation()->FormDigestValue);
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
     * Submits query to SharePoint REST/OData service
     */
    public function executeQuery()
    {
        $this->getPendingRequest()->beforeExecuteQuery(function (RequestOptions $request,ClientAction $query) {
            $this->buildSharePointSpecificRequest($request,$query);
        });
        parent::executeQuery();
    }

    /**
     * @param RequestOptions $request
     * @param ClientAction $query
     * @throws Exception
     */
    private function buildSharePointSpecificRequest(RequestOptions $request,ClientAction $query){

        if($request->Method === HttpMethod::Post) {
            $this->ensureFormDigest($request);
        }


        //set data modification headers
        if ($query instanceof UpdateEntityQuery) {
            $request->addCustomHeader("IF-MATCH", "*");
            $request->addCustomHeader("X-HTTP-Method", "MERGE");
        } else if ($query instanceof DeleteEntityQuery) {
            $request->addCustomHeader("IF-MATCH", "*");
            $request->addCustomHeader("X-HTTP-Method", "DELETE");
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
}
