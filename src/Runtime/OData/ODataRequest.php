<?php


namespace Office365\PHP\Client\Runtime\OData;

use Exception;
use Office365\PHP\Client\Runtime\ClientAction;
use Office365\PHP\Client\Runtime\ClientRequestStatus;
use Office365\PHP\Client\Runtime\ClientResponse;
use Office365\PHP\Client\Runtime\IEntityType;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\ClientRequest;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\HttpMethod;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;


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
     * Submit query to OData service
     * @throws Exception
     */
    public function executeQuery()
    {
        try{
            $this->currentQuery = array_shift($this->queries);
            $request = $this->buildRequest();
            if (is_callable($this->eventsList["BeforeExecuteQuery"])) {
                call_user_func_array($this->eventsList["BeforeExecuteQuery"], array(
                    $request,
                    $this->currentQuery
                ));
            }

            $responseInfo = array();
            $payload = $this->executeQueryDirect($request, $responseInfo);
            $response = new ODataResponse($payload,$responseInfo);
            $response->validate();
            if (is_callable($this->eventsList["AfterExecuteQuery"])) {
                call_user_func_array($this->eventsList["AfterExecuteQuery"], array(
                    $response
                ));
            }
            if (!empty($payload)) {
                $this->processResponse($response);
            }
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
        $queryId = $this->currentQuery->getId();
        if (!array_key_exists($queryId, $this->resultObjects)) {
            return;
        }
        $resultObject = $this->resultObjects[$queryId];
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
        $resourceUrl = $this->context->getServiceRootUrl() . $this->currentQuery->getResourcePath()->toUrl();
        if (!is_null($this->currentQuery->getQueryOptions())) {
            $resourceUrl .= '?' . $this->currentQuery->getQueryOptions()->toUrl();
        }
        $request = new RequestOptions($resourceUrl);
        if ($this->currentQuery instanceof InvokePostMethodQuery) {
            $request->Method = HttpMethod::Post;
            if($this->currentQuery->Value){
                if (is_string($this->currentQuery->Value))
                    $request->Data = $this->currentQuery->Value;
                else{
                    $payload = $this->normalizePayload($this->currentQuery->Value,$this->getFormat());
                    $request->Data = json_encode($payload);
                }
            }
        }
        return $request;
    }


    /**
     * @param $value
     * @param ODataFormat $format
     * @return array
     */
    public function normalizePayload($value,ODataFormat $format)
    {
        if ($value instanceof IEntityType) {
            $payload = array_map(function ($property) use($format){
                return $this->normalizePayload($property,$format);
            }, $value->toJson($format));
            return $payload;
        } else if (is_array($value)) {
            return array_map(function ($item) use($format){
                return $this->normalizePayload($item,$format);
            }, $value);
        }
        return $value;
    }


    /**
     * @return ODataFormat
     */
    protected function getFormat()
    {
        return $this->context->getFormat();
    }


}
