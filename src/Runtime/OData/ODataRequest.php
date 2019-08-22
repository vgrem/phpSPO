<?php


namespace Office365\PHP\Client\Runtime\OData;


use Exception;
use Office365\PHP\Client\Runtime\ClientAction;
use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ClientRequestStatus;
use Office365\PHP\Client\Runtime\ClientResult;
use Office365\PHP\Client\Runtime\IEntityType;
use Office365\PHP\Client\Runtime\InvokeMethodQuery;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\ClientRequest;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\HttpMethod;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use Office365\PHP\Client\SharePoint\ChangeLogItemQuery;



/**
 * Client Request for OData provider.
 */
class ODataRequest extends ClientRequest
{

    public function __construct(ClientRuntimeContext $context)
    {
        parent::__construct($context);
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
                    $this->getCurrentAction()
                ));
            }
            $responseInfo = array();
            $response = $this->executeQueryDirect($request, $responseInfo);
            if ($responseInfo['HttpCode'] >= 400) {
                $error = $this->extractError($response);
                throw new Exception($error['Message']);
            }

            if (!empty($response)) {
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
     * @param string $response
     * @throws Exception
     */
    public function processResponse($response)
    {
        if (!array_key_exists($this->getCurrentAction()->getId(), $this->resultObjects)) {
            return;
        }
        $resultObject = $this->resultObjects[$this->getCurrentAction()->getId()];

        if ($this->getCurrentAction() instanceof InvokePostMethodQuery && $this->getCurrentAction()->MethodBody instanceof ChangeLogItemQuery) {
            $this->processXmlResponse($response,$resultObject);
        } else {
            $this->processJsonResponse($response,$resultObject);
        }
    }


    /**
     * @param string $response
     * @param ClientObject|ClientResult $resultObject
     * @throws Exception
     */
    private function processJsonResponse($response, $resultObject)
    {
        $payload = json_decode($response);
        if ($resultObject instanceof ClientResult) {
            if ($this->getCurrentAction() instanceof InvokeMethodQuery){
                $this->getSerializationContext()->RootElement = $this->getCurrentAction()->MethodName;
            }
            $resultObject->fromJson($payload,$this->getSerializationContext());
        } else if($resultObject instanceof IEntityType) {
            $this->getSerializationContext()->map($payload,$resultObject);
            $this->getCurrentAction()->getResourcePath()->ServerObjectIsNull = false;
        }
    }


    /**
     * Process Xml response from SharePoint REST service
     * @param string $response
     * @param ClientObject $resultObject
     */
    private function processXmlResponse($response, $resultObject)
    {
        $payload = array();
        $xml = simplexml_load_string($response);
        $xml->registerXPathNamespace('z', '#RowsetSchema');
        $rows = $xml->xpath("//z:row");
        foreach ($rows as $row) {
            $item = null;
            foreach ($row->attributes() as $k => $v) {
                $normalizedFieldName = str_replace('ows_', '', $k);
                $item[$normalizedFieldName] = (string)$v;
            }
            $payload[] = $item;
        }
        $this->getSerializationContext()->map($payload,$resultObject);
    }


    /**
     * Extract error from JSON payload response
     * @param mixed $response
     * @return array
     * @throws Exception
     */
    private function extractError($response)
    {
        $error = array();
        $parsedResponse = json_decode($response);
        if (null !== $parsedResponse && property_exists($parsedResponse, 'error')) {
            if (is_string($parsedResponse->error->message)) {
                $message = $parsedResponse->error->message;
            } elseif (is_object($parsedResponse->error->message)) {
                $message = $parsedResponse->error->message->value;
            } else {
                $message = "Unknown error";
            }
            $error['Message'] = $message;
            return $error;
        }

        if (is_string($response)) {
            return ['Message' => $response];
        }

        return null;
    }

    /**
     * @param RequestOptions $request
     */
    protected function setRequestHeaders(RequestOptions $request)
    {
        $request->addCustomHeader("Accept", $this->getSerializationContext()->getMediaType());
        $request->addCustomHeader("content-type", $this->getSerializationContext()->getMediaType());
    }


    /**
     * @return RequestOptions
     */
    public function buildRequest()
    {
        $resourceUrl = $this->context->getServiceRootUrl() . $this->getCurrentAction()->getResourcePath()->toUrl();
        if (!is_null($this->getCurrentAction()->getQueryOptions())) {
            $resourceUrl .= '?' . $this->getCurrentAction()->getQueryOptions()->toUrl();
        }
        $request = new RequestOptions($resourceUrl);
        if ($this->getCurrentAction() instanceof InvokePostMethodQuery) {
            $request->Method = HttpMethod::Post;
            if (is_string($this->getCurrentAction()->MethodBody))
                $request->Data = $this->getCurrentAction()->MethodBody;
            else if ($this->getCurrentAction()->MethodBody instanceof IEntityType) {
                //build request payload
                $payload = $this->getSerializationContext()->normalize($this->getCurrentAction()->MethodBody);
                $request->Data = json_encode($payload);
            }
        }
        return $request;
    }


    /**
     * @return ODataSerializerContext
     */
    protected function getSerializationContext()
    {
        return $this->context->getSerializerContext();
    }


    /**
     * @return ClientAction|InvokePostMethodQuery
     */
    protected function getCurrentAction(){
        return current($this->queries);
    }


    /**
     * @return ClientRequest
     */
    public function getNextRequest()
    {
        $request = new ODataRequest($this->context);
        if(count($this->queries) > 1) {
            $request->queries = array_slice($this->queries, 1, count($this->queries)-1, true);
            $request->resultObjects = $this->resultObjects;
        }
        return $request;
    }


}
