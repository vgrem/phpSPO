<?php


namespace Office365\Runtime;


use Exception;
use Office365\Runtime\Actions\ClientAction;
use Office365\Runtime\Http\RequestException;
use Office365\Runtime\Http\Requests;
use Office365\Runtime\Http\Response;
use Office365\Runtime\Types\EventHandler;
use Office365\Runtime\Types\Guid;
use Office365\Runtime\Http\RequestOptions;


/**
 * Client Request for OData provider.
 *
 */
abstract class ClientRequest
{
    /**
     * @var EventHandler
     */
    protected $beforeExecute;

    /**
     * @var EventHandler
     */
    protected $afterExecute;

    /**
     * @var ClientRuntimeContext
     */
    protected $context;


    /**
     * @var ClientAction[]
     */
    protected $queries = array();


    /**
     * @var ClientAction
     */
    protected $currentQuery = null;

    /** @var Guid  */
    protected $requestId;

    /** @var integer */
    protected $requestStatus;


    /**
     * ClientRequest constructor.
     * @param ClientRuntimeContext $context
     */
    public function __construct(ClientRuntimeContext $context)
    {
        $this->context = $context;
        $this->beforeExecute = new EventHandler();
        $this->afterExecute = new EventHandler();
        $this->requestId = Guid::newGuid();
        $this->requestStatus = ClientRequestStatus::Active;
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


    /**
     * Add query into request queue
     * @param ClientAction $query
     * @param bool $toBegin
     */
    public function addQuery(ClientAction $query,$toBegin=false)
    {
        if($toBegin)
            array_unshift($this->queries , $query);
        else
            $this->queries[] = $query;
        $this->currentQuery = $query;
    }

    /**
     * @param ClientAction $query
     * @param ClientObject|ClientResult $resultObject
     */
    public function addQueryAndResultObject(ClientAction $query, $resultObject = null)
    {
        $query->ReturnType = $resultObject;
        $this->addQuery($query);
    }


    /**
     * @param callable $event
     * @param bool $toBegin
     */
    public function beforeExecuteRequest(callable $event, $toBegin=false)
    {
        $this->beforeExecute->addEvent($event,false,$toBegin);
    }

    /**
     * @param callable $event
     * @param false $toBegin
     */
    public function beforeExecuteRequestOnce(callable $event, $toBegin=false)
    {
        $this->beforeExecute->addEvent($event,true,$toBegin);
    }

    /**
     * @param callable $event
     * @param bool $once
     */
    public function afterExecuteRequest(callable $event,$once=true)
    {
        $this->afterExecute->addEvent($event,$once);
    }

    /**
     * Submit a query
     * @throws Exception
     */
    public function executeQuery()
    {
        while ($this->getNextQuery() !== null) {
            try{
                $request = $this->buildRequest();
                $this->beforeExecute->triggerEvent(array($request));
                $response = $this->executeQueryDirect($request);
                $this->processResponse($response);
                $this->afterExecute->triggerEvent(array($response));
                $this->requestStatus = ClientRequestStatus::CompletedSuccess;
            }
            catch(Exception $e){
                $this->requestStatus = ClientRequestStatus::CompletedException;
                throw $e;
            }
        }
    }

    /**
     * @param RequestOptions $request
     * @return Response
     * @throws Exception
     */
    public function executeQueryDirect(RequestOptions $request)
    {
        $this->context->authenticateRequest($request);
        $response = Requests::execute($request);
        $this->validate($response);
        return $response;
    }


    /**
     * @param Response $response
     */
    public abstract function processResponse($response);

    /**
     * Build Request
     * @return RequestOptions
     */
    abstract public function buildRequest();


    /**
     * @return ClientAction[]
     */
    public function getActions(){
        return $this->queries;
    }

    public function clearActions(){
        $this->queries = array();
    }

    /**
     * @return int
     */
    public function getRequestStatus(){
        return $this->requestStatus;
    }


    /**
     * @param Response $response
     * @return bool
     * @throws Exception
     */
    public function validate($response)
    {
        if ($response->getStatusCode() >= 400) {
            throw new RequestException($response->getContent(),$response->getStatusCode());
        }
        return true;
    }

}
