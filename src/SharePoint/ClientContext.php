<?php

namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\Auth\IAuthenticationContext;
use Office365\PHP\Client\Runtime\ClientAction;
use Office365\PHP\Client\Runtime\ClientResult;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\ContextWebInformation;
use Office365\PHP\Client\Runtime\HttpMethod;
use Office365\PHP\Client\Runtime\OData\JsonLightSerializerContext;
use Office365\PHP\Client\Runtime\OData\ODataMetadataLevel;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;

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
     * ClientContext constructor.
     * @param string $serviceUrl
     * @param IAuthenticationContext $authCtx
     */
    public function __construct($serviceUrl, IAuthenticationContext $authCtx)
    {
        $serviceRootUrl = $serviceUrl . '/_api/';
        parent::__construct($serviceRootUrl,$authCtx,new JsonLightSerializerContext(ODataMetadataLevel::Verbose));
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
        $request->addCustomHeader("X-RequestDigest",$this->getContextWebInformation()->FormDigestValue);
    }

    /**
     * Request the SharePoint Context Info
     */
    public function requestFormDigest()
    {
        $request = new RequestOptions($this->getServiceRootUrl() . "contextinfo");
        $request->Method = HttpMethod::Post;
        $response = $this->executeQueryDirect($request);
        if(!isset($this->contextWebInformation))
            $this->contextWebInformation = new ContextWebInformation();
        $result = new ClientResult($this->contextWebInformation);
        if ($this->getSerializerContext()->MetadataLevel == ODataMetadataLevel::Verbose) {
            $this->getSerializerContext()->RootElement = "GetContextWebInformation";
        }
        $payload = json_decode($response);
        $result->fromJson($payload,$this->getSerializerContext());
    }

    /**
     * Submits query to SharePoint REST/OData service
     */
    public function executeQuery()
    {
        $this->getPendingRequest()->beforeExecuteQuery(function (RequestOptions $request,ClientAction $query){
            $this->buildSharePointSpecificRequest($request,$query);
        });
        parent::executeQuery();
    }

    /**
     * @param RequestOptions $request
     * @param ClientAction $query
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
            $this->web = new Web($this,new ResourcePathEntity($this,null,"Web"));
        }
        return $this->web;
    }

    /**
     * @return Site
     */
    public function getSite()
    {
        if(!isset($this->site)){
            $this->site = new Site($this, new ResourcePathEntity($this,null,"Site"));
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
