<?php


namespace Office365\PHP\Client\Runtime\OData;


use Exception;
use Office365\PHP\Client\Runtime\ClientAction;
use Office365\PHP\Client\Runtime\ClientRequestStatus;
use Office365\PHP\Client\Runtime\ClientResponse;
use Office365\PHP\Client\Runtime\ClientRequest;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use Office365\PHP\Client\Runtime\Utilities\Requests;


/**
 * Client Request for OData provider.
 */
class ODataRequest extends ClientRequest
{

    /**
     * @var ClientAction
     */
    private $currentQuery;

    public function __construct(ClientRuntimeContext $context)
    {
        parent::__construct($context);
        $this->currentQuery = null;
    }



    /**
     * @param RequestOptions $request
     * @return ClientResponse
     * @throws Exception
     */
    public function executeQueryDirect(RequestOptions $request)
    {
        $this->context->authenticateRequest($request); //Auth mandatory headers
        $this->setRequestHeaders($request); //set request headers
        $content = Requests::execute($request,$responseInfo);
        return new ODataResponse($content,$responseInfo);
    }


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
                    $request,
                    $this->currentQuery
                ));
            }

            $response = $this->executeQueryDirect($request);
            $response->validate();
            if (is_callable($this->eventsList["AfterExecuteQuery"])) {
                call_user_func_array($this->eventsList["AfterExecuteQuery"], array(
                    $response
                ));
            }
            $this->processResponse($response);
            $this->requestStatus = ClientRequestStatus::CompletedSuccess;
        }
        catch(Exception $e){
            $this->requestStatus = ClientRequestStatus::CompletedException;
            throw $e;
        }
    }


    /**
     * @param ClientResponse $response
     * @throws Exception
     */
    public function processResponse($response)
    {
        $payload = $response->getContent();
        if (empty($payload)) {
            return;
        }

        $queryId = $this->currentQuery->getId();
        $resultObject = $this->resultObjects[$queryId];
        if (is_null($resultObject)) {
            return;
        }
        $response->map($resultObject, $this->getFormat());
    }



    /**
     * @param RequestOptions $request
     */
    protected function setRequestHeaders(RequestOptions $request)
    {
        $request->addCustomHeader("Accept", $this->getFormat()->getMediaType());
        $request->addCustomHeader("content-type", $this->getFormat()->getMediaType());
    }

    /**
     * @return RequestOptions
     */
    protected function buildRequest()
    {
        $this->currentQuery = array_shift($this->queries);
        return $this->currentQuery->buildRequest();
    }


    /**
     * @return ODataFormat
     */
    protected function getFormat()
    {
        return $this->context->getFormat();
    }


}
