<?php

namespace Office365\PHP\Client\Runtime;

use Exception;
use Office365\PHP\Client\Runtime\Auth\IAuthenticationContext;
use Office365\PHP\Client\Runtime\Http\Response;
use Office365\PHP\Client\Runtime\Http\RequestOptions;



/**
 * Generic runtime context
 */
abstract class ClientRuntimeContext
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
     * @var Version $RequestSchemaVersion
     */
    public $RequestSchemaVersion;

    /**
     * @param string $serviceUrl
     * @param IAuthenticationContext $authContext
     * @param string $version
     */
    public function __construct($serviceUrl, IAuthenticationContext $authContext, $version = Office365Version::V1)
    {
        $this->version = $version;
        $this->serviceRootUrl = $serviceUrl;
        $this->authContext = $authContext;
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
     *
     */
    public function load(ClientObject $clientObject, array $selectProperties = null)
    {
        $qry = new ReadEntityQuery($clientObject,$selectProperties);
        $this->getPendingRequest()->addQueryAndResultObject($qry, $clientObject);
    }


    /**
     * @param ClientAction $query
     * @param ClientObject|ClientValueObject|ClientResult $resultObject
     */
    public function addQueryAndResultObject(ClientAction $query, $resultObject)
    {
        $this->getPendingRequest()->addQueryAndResultObject($query, $resultObject);
    }


    /**
     * @param ClientAction $query
     */
    public function addQuery(ClientAction $query)
    {
        $this->getPendingRequest()->addQuery($query);
    }

    /**
     * Submit client request to OData or SOAP based service
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
     * @return Response
     * @throws Exception
     */
    public function executeQueryDirect(RequestOptions $options)
    {
        return $this->getPendingRequest()->executeQueryDirect($options);
    }

    /**
     * @return ClientRequest
     */
    public abstract function getPendingRequest();


    /**
     * @return bool
     */
    public function hasPendingRequest()
    {
        return count($this->getPendingRequest()->getActions()) > 0;
    }


    /**
     * Gets the build version of Microsoft.SharePoint.Client.ServerRuntime.dll on the server.
     * @return Version
     */
    public function getServerLibraryVersion(){
        return new Version();
    }
}
