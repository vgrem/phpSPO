<?php


namespace Office365\PHP\Client\Runtime;


use Office365\PHP\Client\Runtime\OData\ODataQueryOptions;
use Office365\PHP\Client\Runtime\Utilities\Guid;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use Office365\PHP\Client\Runtime\Utilities\Requests;


/**
 * Client Request for OData provider.
 *
 */
abstract class ClientRequest
{
    /**
     * @var array
     */
    protected $eventsList;

    /**
     * @var ClientRuntimeContext
     */
    protected $context;


    /**
     * @var ClientAction[]
     */
    protected $queries = array();

    /**
     * @var array
     */
    protected $resultObjects = array();


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
        $this->eventsList = array(
            "BeforeExecuteQuery" => null,
            "AfterExecuteQuery" => null
        );
        $this->requestId = Guid::newGuid();
        $this->requestStatus = ClientRequestStatus::Active;
    }

    /**
     * Add query into request queue
     * @param ClientAction $query
     * @param ClientObject $resultObject
     */
    public function addQuery(ClientAction $query, $resultObject = null)
    {
        if (isset($resultObject)) {
            $queryId = $query->getId();
            $this->resultObjects[$queryId] = $resultObject;
        }
        $this->queries[] = $query;
    }

    /**
     * @param callable $event
     */
    public function beforeExecuteQuery(callable $event)
    {
        $this->eventsList["BeforeExecuteQuery"] = $event;
    }

    /**
     * @param callable $event
     */
    public function afterExecuteQuery(callable $event)
    {
        $this->eventsList["AfterExecuteQuery"] = $event;
    }

    /**
     * Submit client request(s) to Office 365 API OData/SOAP service
     */
    public abstract function executeQuery();


    /**
     * @param RequestOptions $request
     */
    protected abstract function setRequestHeaders(RequestOptions $request);


    /**
     * @param string $response
     */
    public abstract function processResponse($response);

    /**
     * Build Client Request
     * @return RequestOptions
     */
    protected abstract function buildRequest();

    /**
     * @param ClientObject $clientObject
     * @param ODataQueryOptions $queryOptions
     */
    public function addQueryAndResultObject(ClientObject $clientObject, ODataQueryOptions $queryOptions = null)
    {
        $qry = new ReadEntityQuery($clientObject,$queryOptions);
        $this->addQuery($qry, $clientObject);
    }


    /**
     * @param RequestOptions $request
     * @param array $responseInfo
     * @return string
     * @throws \Exception
     */
    public function executeQueryDirect(RequestOptions $request,&$responseInfo=array())
    {
        $this->context->authenticateRequest($request); //Auth mandatory headers
        $this->setRequestHeaders($request); //set request headers
        return Requests::execute($request,$responseInfo);
    }

    /**
     * @return ClientAction[]
     */
    public function getActions(){
        return $this->queries;
    }

    /**
     * @return int
     */
    public function getRequestStatus(){
        return $this->requestStatus;
    }

    /**
     * @return ClientRequest
     */
    public abstract function getNextRequest();
}
