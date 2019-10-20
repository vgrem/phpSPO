<?php

namespace Office365\PHP\Client\Runtime;

use Exception;
use Office365\PHP\Client\Runtime\Auth\IAuthenticationContext;
use Office365\PHP\Client\Runtime\OData\ODataRequest;
use Office365\PHP\Client\Runtime\OData\ODataFormat;
use Office365\PHP\Client\Runtime\OData\ODataQueryOptions;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use Office365\PHP\Client\Runtime\Utilities\Version;



/**
 * OData Runtime context for Office365 APIs
 */
class ClientRuntimeContext
{
    /**
     * Service Root url
     * @var string
     */
    private $serviceRootUrl;

    /**
     * Service version
     * @var string
     */
    private $version;

    /**
     * @var IAuthenticationContext
     */
    private $authContext;

    /**
     * @var ClientRequest
     */
    private $pendingRequest;

    /**
     * @var ODataFormat
     */
    private $format;


    /**
     * @var Version $RequestSchemaVersion
     */
    public $RequestSchemaVersion;

    /**
     * REST client context ctor
     * @param string $serviceUrl
     * @param IAuthenticationContext $authContext
     * @param ODataFormat $format
     * @param string $version
     */
    public function __construct($serviceUrl, IAuthenticationContext $authContext, ODataFormat $format, $version = Office365Version::V1)
    {
        $this->version = $version;
        $this->serviceRootUrl = $serviceUrl;
        $this->authContext = $authContext;
        $this->format = $format;
    }

    /**
     * @param RequestOptions $options
     */
    public function authenticateRequest(RequestOptions $options)
    {
        $this->authContext->authenticateRequest($options);
    }

    /**
     * Gets the service root URL that identifies the root of an OData service
     * @return string
     */
    public function getServiceRootUrl()
    {
        return $this->serviceRootUrl;
    }


    /**
     * @param $url string
     */
    public function setServiceRootUrl($url)
    {
        $this->serviceRootUrl = $url;
    }

    /**
     * Gets the api version being used
     * @return string
     */
    public function getApiVersion()
    {
        return $this->version;
    }

    /**
     * Prepare to load resource
     * @param ClientObject $clientObject
     * @param array $selectProperties
     * @return ClientRuntimeContext
     *
     */
    public function load(ClientObject $clientObject, array $selectProperties = null)
    {
        if(!is_null($selectProperties)) {
            $queryOptions = new ODataQueryOptions();
            $queryOptions->Select = implode(",",$selectProperties);
            $this->getPendingRequest()->addQueryAndResultObject($clientObject, $queryOptions);
        }
        else{
            $queryOptions = null;
            if($clientObject instanceof ClientObjectCollection)
                $queryOptions = $clientObject->getQueryOptions();
            $this->getPendingRequest()->addQueryAndResultObject($clientObject,$queryOptions);
        }
        return $this;
    }


    /**
     * @param ClientObject $clientObject
     * @param ODataQueryOptions $query
     */
    public  function loadQuery(ClientObject $clientObject,ODataQueryOptions $query = null)
    {
        $this->getPendingRequest()->addQueryAndResultObject($clientObject, $query);
    }

    /**
     * Submit client request to SharePoint OData/SOAP service
     *
     */
    public function executeQuery()
    {
        while ($this->hasPendingRequest()) {
            $this->getPendingRequest()->executeQuery();
        }
    }

    /**
     * @param RequestOptions $options
     * @return ClientResponse
     * @throws Exception
     */
    public function executeQueryDirect(RequestOptions $options)
    {
        return $this->getPendingRequest()->executeQueryDirect($options);
    }


    /**
     * @param ClientAction $query
     * @param ClientObject|ClientResult $resultObject
     * @return self
     */
    public function addQuery(ClientAction $query, $resultObject = null)
    {
        $this->getPendingRequest()->addQuery($query, $resultObject);
        return $this;
    }

    /**
     * @return ClientRequest
     */
    public function getPendingRequest()
    {
        if (!isset($this->pendingRequest)) {
            $this->pendingRequest = new ODataRequest($this);
        }
        return $this->pendingRequest;
    }


    /**
     * @return bool
     */
    public function hasPendingRequest()
    {
        $request = $this->getPendingRequest();
        return count($request->getActions()) > 0;
    }


    /**
     * Gets the build version of Microsoft.SharePoint.Client.ServerRuntime.dll on the server.
     * @return Version
     */
    public function getServerLibraryVersion(){
        return new Version();
    }


    /**
     * @return ODataFormat
     */
    public function getFormat()
    {
        return $this->format;
    }

}
