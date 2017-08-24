<?php


namespace Office365\PHP\Client\Runtime\OData;


use Exception;
use Office365\PHP\Client\Runtime\ClientAction;
use Office365\PHP\Client\Runtime\CreateEntityQuery;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\InvokeMethodQuery;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
use Office365\PHP\Client\Runtime\ClientRequest;
use Office365\PHP\Client\Runtime\ClientResult;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\FormatType;
use Office365\PHP\Client\Runtime\HttpMethod;
use Office365\PHP\Client\Runtime\Utilities\JsonConvert;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use Office365\PHP\Client\SharePoint\ListItemCollection;

/**
 * Client Request for OData provider.
 */
class ODataRequest extends ClientRequest
{
    /**
     * @var int
     */
    private $payloadFormatType;

    /**
     * @var ODataFormat
     */
    private $format;



    public function __construct(ClientRuntimeContext $context, ODataFormat $format)
    {
        $this->payloadFormatType = FormatType::Json;
        $this->format = $format;
        parent::__construct($context);
    }



    public function executeQuery()
    {
        $serializer = new ODataPayloadSerializer($this->format);
        while(($qry = array_shift($this->queries)) !== null) {
            $request = $this->buildRequest($qry);
            if (is_callable($this->eventsList["BeforeExecuteQuery"])) {
                call_user_func_array($this->eventsList["BeforeExecuteQuery"], array(
                    $request,
                    $qry
                ));
            }
            $response = $this->executeQueryDirect($request);
            if (empty($response)) {
                continue;
            }
            $responseType = $this->validateResponse($response);
            //if(is_callable($this->eventsList["AfterExecuteQuery"]))
            //    call_user_func_array($this->eventsList["AfterExecuteQuery"],array($payload));
            //populate object
            if (array_key_exists($qry->getId(), $this->resultObjects)) {
                $resultObject = $this->resultObjects[$qry->getId()];
                if ($resultObject instanceof ListItemCollection && $responseType == FormatType::Xml) {
                    $resultObject->populateFromXmlPayload($response); //custom payload process
                }else {
                    if ($resultObject instanceof ClientResult && $qry instanceof InvokeMethodQuery) {
                        $resultObject->EntityName = $qry->MethodName;
                    }
                    $serializer->deserialize($response, $resultObject);
                }
                unset($this->resultObjects[$qry->getId()]);
            }
        }
    }


    /**
     * @param string $response
     * @param ODataPayload $resultObject
     */
    public function processResponse($response, $resultObject)
    {
        $ser = new ODataPayloadSerializer($this->format);
        $ser->deserialize($response, $resultObject);
    }

    /**
     * @param $response
     * @return int
     * @throws Exception
     */
    private function validateResponse($response)
    {
        $json = JsonConvert::deserialize($response);
        if (json_last_error() != JSON_ERROR_NONE) {
            return FormatType::Xml;
        }
        if (property_exists($json, 'error')) {
            if (is_string($json->error->message)) {
                $message = $json->error->message;
            }elseif (is_object($json->error->message)) {
                $message = $json->error->message->value;
            }else{
                $message = "Unknown error";
            }
            throw new Exception($message);
        }
        return FormatType::Json;
    }

    /**
     * @param RequestOptions $request
     */
    protected function setRequestHeaders(RequestOptions $request)
    {
        $request->addCustomHeader("Accept", $this->format->getMediaType());
        $request->addCustomHeader("content-type", $this->format->getMediaType());
    }


    /**
     * @param ClientAction $query
     * @return RequestOptions
     */
    public function buildRequest(ClientAction $query)
    {
        $resourceUrl = $this->context->getServiceRootUrl() . $query->ResourcePath->toUrl();
        if (!is_null($query->QueryOptions)) {
            $resourceUrl .= '?' . $query->QueryOptions->toUrl();
        }
        $request = new RequestOptions($resourceUrl);
        if ($query instanceof InvokePostMethodQuery ||
            $query instanceof CreateEntityQuery ||
            $query instanceof UpdateEntityQuery ||
            $query instanceof DeleteEntityQuery
        ) {
            $request->Method = HttpMethod::Post;
        }
        //set payload
        if (!is_null($query->Payload)) {
            if (is_string($query->Payload))
                $request->Data = $query->Payload;
            else {
                $serializer = new ODataPayloadSerializer($this->format);
                $request->Data = $serializer->serialize($query->Payload);
            }
        }
        return $request;
    }



}