<?php

namespace Office365\Runtime;

use Exception;
use Office365\Runtime\Actions\ClientAction;
use Office365\Runtime\Actions\ReadEntityQuery;
use Office365\Runtime\Http\RequestException;
use Office365\Runtime\Http\Response;
use Office365\Runtime\Http\RequestOptions;


/**
 * Generic runtime context
 */
abstract class ClientRuntimeContext
{

    /**
     * @var ClientAction
     */
    protected $currentQuery = null;

    /**
     * @var ClientAction[]
     */
    protected $queries = array();

    /**
     * @var Version $RequestSchemaVersion
     */
    public $RequestSchemaVersion;


    public function __construct()
    {
    }


    /**
     * @return RequestOptions
     */
    public function buildRequest(){
       return $this->getPendingRequest()->buildRequest($this->getCurrentQuery());
    }

    /**
     * @param RequestOptions $options
     */
    public abstract function authenticateRequest(RequestOptions $options);


    /**
     * Gets the service root URL that identifies the root of an OData service
     * @return string
     */
    public abstract function getServiceRootUrl();


    /**
     * Prepare to load resource
     * @param ClientObject $clientObject
     * @param string[] $includeProperties
     * @return ClientRuntimeContext
     */
    public function load(ClientObject $clientObject, array $includeProperties = null)
    {
        $qry = new ReadEntityQuery($clientObject,$includeProperties);
        $this->addQueryAndResultObject($qry, $clientObject);
        return $this;
    }


    /**
     * Submit a client request
     */
    public function executeQuery()
    {
        while ($this->hasPendingRequest()) {
            $qry = $this->getNextQuery();
            $this->getPendingRequest()->executeQuery($qry);
        }
    }


    /**
     * Submit a query along with handling transient failures
     * @param int $retryCount
     * @param int $delaySecs
     * @throws Exception
     */
    public function executeQueryRetry($retryCount,$delaySecs, $currentRetry=0)
    {
        try{
            $this->executeQuery();
        }
        catch(Exception $ex) {
            if ($currentRetry > $retryCount || !($ex instanceof RequestException))
            {
                throw $ex;
            }
            sleep($delaySecs);
            $this->addQuery($this->getCurrentQuery(),true);
            $this->executeQueryRetry($retryCount,$delaySecs, $currentRetry+1);
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
        return count($this->getActions()) > 0;
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
     * @param ClientAction $query
     * @param ClientObject|ClientResult $returnType
     */
    public function addQueryAndResultObject(ClientAction $query, $returnType = null)
    {
        $query->ReturnType = $returnType;
        $this->addQuery($query, false);
    }


    /**
     * Gets the build version.
     * @return Version
     */
    public function getServerLibraryVersion(){
        return new Version();
    }

    /**
     * @return ClientAction|null
     */
    protected function getNextQuery()
    {
        $qry = array_shift($this->queries);
        $this->currentQuery = $qry;
        return $qry;
    }

    /**
     * @return ClientAction
     */
    public function getCurrentQuery(){
        return $this->currentQuery;
    }

    public function clearActions(){
        $this->queries = array();
    }

    /**
     * @return ClientAction[]
     */
    public function getActions(){
        return $this->queries;
    }

    /**
     * Add query into request queue
     * @param ClientAction $query
     * @param bool $executeFirst
     */
    public function addQuery(ClientAction $query, $executeFirst=false)
    {
        if($executeFirst)
            array_unshift($this->queries , $query);
        else
            $this->queries[] = $query;
    }
}
