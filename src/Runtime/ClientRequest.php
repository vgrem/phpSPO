<?php


namespace Office365\Runtime;


use Exception;
use Office365\Runtime\Http\RequestException;
use Office365\Runtime\Http\Requests;
use Office365\Runtime\Http\Response;
use Office365\Runtime\Types\Guid;
use Office365\Runtime\Http\RequestOptions;


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
     */
    public function addQuery(ClientAction $query)
    {
        $this->queries[] = $query;
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
     * Submit client request(s)
     */
    /**
     * Submit query to OData service
     * @throws Exception
     */
    public function executeQuery()
    {
        try{
            $request = $this->buildRequest();
            if (is_callable($this->eventsList["BeforeExecuteQuery"])) {
                call_user_func_array($this->eventsList["BeforeExecuteQuery"], array(
                    $request
                ));
            }

            $response = $this->executeQueryDirect($request);
            $this->processResponse($response);
            if (is_callable($this->eventsList["AfterExecuteQuery"])) {
                call_user_func_array($this->eventsList["AfterExecuteQuery"], array(
                    $response
                ));
            }
            $this->requestStatus = ClientRequestStatus::CompletedSuccess;
        }
        catch(Exception $e){
            $this->requestStatus = ClientRequestStatus::CompletedException;
            throw $e;
        }
    }



    /**
     * @param RequestOptions $request
     * @return Response
     * @throws Exception
     */
    /**
     * @param RequestOptions $request
     * @return Response
     * @throws Exception
     */
    public function executeQueryDirect(RequestOptions $request)
    {
        $this->context->authenticateRequest($request); //Auth mandatory headers
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
    protected abstract function buildRequest();


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
