<?php

namespace Office365\Runtime;

use Exception;
use Office365\Runtime\Auth\IAuthenticationContext;
use Office365\Runtime\Http\Response;
use Office365\Runtime\Http\RequestOptions;


/**
 * Generic runtime context
 */
abstract class ClientRuntimeContext
{

    /**
     * @var IAuthenticationContext
     */
    protected $authContext;



    /**
     * @var Version $RequestSchemaVersion
     */
    public $RequestSchemaVersion;


    /**
     * @var ClientAction
     */
    protected $currentQuery = array();


    /**
     * @param IAuthenticationContext $authContext
     */
    public function __construct(IAuthenticationContext $authContext=null)
    {
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
    public abstract function getServiceRootUrl();


    /**
     * @return ClientAction
     */
    public function getCurrentQuery(){
        return $this->currentQuery;
    }

    /**
     * Prepare to load resource
     * @param ClientObject $clientObject
     * @param array $includeProperties
     * @param callable|null $loaded
     */
    public function load(ClientObject $clientObject, array $includeProperties = null, callable $loaded=null)
    {
        $qry = new ReadEntityQuery($clientObject,$includeProperties);
        $this->getPendingRequest()->addQueryAndResultObject($qry, $clientObject);
        $this->getPendingRequest()->afterExecuteRequest(function () use ($loaded, $qry) {
            if($this->getCurrentQuery()->getId() == $qry->getId())
                if(is_callable($loaded)) call_user_func($loaded, $this);
        },false);
    }


    /**
     * @param ClientAction $query
     * @param ClientObject|ClientValue|ClientResult $resultObject
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
            $this->currentQuery = $this->getPendingRequest()->getNextQuery();
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
     * Gets the build version.
     * @return Version
     */
    public function getServerLibraryVersion(){
        return new Version();
    }
}
