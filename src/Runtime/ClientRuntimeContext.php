<?php

namespace Office365\Runtime;

use Exception;
use Office365\Runtime\Actions\ClientAction;
use Office365\Runtime\Actions\ReadEntityQuery;
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
     * @return RequestOptions
     */
    public function buildRequest(){
       return $this->getPendingRequest()->buildRequest();
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
        return $this->getPendingRequest()->getCurrentQuery();
    }

    /**
     * Prepare to load resource
     * @param ClientObject $clientObject
     * @param array $includeProperties
     */
    public function load(ClientObject $clientObject, array $includeProperties = null)
    {
        $qry = new ReadEntityQuery($clientObject,$includeProperties);
        $this->addQueryAndResultObject($qry, $clientObject);
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
     * Submit a client request
     *
     */
    public function executeQuery()
    {
        if ($this->hasPendingRequest()) {
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
     * @param callable $callback
     */
    public function afterExecuteQuery($callback){
        $this->getPendingRequest()->afterExecuteRequest(function () use ($callback) {
            $qry = $this->getCurrentQuery();
            if(is_callable($callback)) call_user_func($callback, $qry);
        },false);
    }


    /**
     * Gets the build version.
     * @return Version
     */
    public function getServerLibraryVersion(){
        return new Version();
    }
}
