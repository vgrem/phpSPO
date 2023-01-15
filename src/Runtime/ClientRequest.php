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


    /** @var Guid */
    protected $requestId;

    /** @var integer */
    protected $requestStatus;


    public function __construct()
    {
        $this->beforeExecute = new EventHandler();
        $this->afterExecute = new EventHandler();
        $this->requestId = Guid::newGuid();
        $this->requestStatus = ClientRequestStatus::Active;
    }


    /**
     * @param callable $event
     */
    public function beforeExecuteRequest(callable $event)
    {
        $this->beforeExecute->addEvent($event, false);
    }

    /**
     * @param callable $event
     */
    public function beforeExecuteRequestOnce(callable $event)
    {
        $this->beforeExecute->addEvent($event, true);
    }

    /**
     * @param callable $event
     * @param bool $once
     */
    public function afterExecuteRequest(callable $event, $once = true)
    {
        $this->afterExecute->addEvent($event, $once);
    }

    /**
     * Submit a query
     * @throws Exception
     */
    public function executeQuery($query)
    {
        try {
            $request = $this->buildRequest($query);
            $response = $this->executeQueryDirect($request);
            $this->processResponse($response, $query);
            $this->afterExecute->triggerEvent(array($response));
            $this->requestStatus = ClientRequestStatus::CompletedSuccess;
        } catch (Exception $e) {
            $this->requestStatus = ClientRequestStatus::CompletedException;
            throw $e;
        }
    }

    /**
     * @param RequestOptions $request
     * @return Response
     * @throws Exception
     */
    public function executeQueryDirect(RequestOptions $request)
    {
        $this->beforeExecute->triggerEvent(array($request));
        $response = Requests::execute($request);
        $this->validate($response);
        return $response;
    }


    /**
     * @param Response $response
     * @param ClientAction $query
     */
    public abstract function processResponse($response, $query);

    /**
     * Build Request
     * @param ClientAction $query
     * @return RequestOptions
     */
    abstract public function buildRequest($query);

    /**
     * @return int
     */
    public function getRequestStatus()
    {
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
            throw new RequestException($response->getContent(), $response->getStatusCode());
        }
        return true;
    }

}
