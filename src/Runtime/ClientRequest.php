<?php


namespace Office365\PHP\Client\Runtime;


use Exception;
use Office365\PHP\Client\Runtime\OData\ODataFormat;
use Office365\PHP\Client\Runtime\OData\ODataPayload;
use Office365\PHP\Client\Runtime\OData\JsonPayloadSerializer;
use Office365\PHP\Client\Runtime\Utilities\JsonConvert;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use Office365\PHP\Client\Runtime\Utilities\Requests;
use Office365\PHP\Client\SharePoint\ListItemCollection;

require_once('FormatType.php');
require_once('Utilities/Requests.php');

/**
 * Client Request for OData provider.
 *
 */
class ClientRequest
{

    /**
     * @var array
     */
    private $eventsList;

    /**
     * @var ClientRuntimeContext
     */
    private $context;


    /**
     * @var int
     */
    private $payloadFormatType;


    /**
     * @var ODataFormat
     */
    private $format;

    /**
     * @var array
     */
    protected $queries = array();

    /**
     * @var array
     */
    protected $resultObjects = array();


    /**
     * ClientRequest constructor.
     * @param ClientRuntimeContext $context
     * @param ODataFormat $format
     */
    public function __construct(ClientRuntimeContext $context,ODataFormat $format)
    {
        $this->context = $context;
        $this->payloadFormatType = FormatType::Json;
        $this->format = $format;
        $this->eventsList = array(
            "BeforeExecuteQuery" => null,
            "AfterExecuteQuery" => null
        );
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


    public function beforeExecuteQuery(callable $event)
    {
        $this->eventsList["BeforeExecuteQuery"] = $event;
    }

    public function afterExecuteQuery(callable $event)
    {
        $this->eventsList["AfterExecuteQuery"] = $event;
    }

    /**
     * @param RequestOptions $request
     * @return ODataPayload
     */
    public function executeQueryDirect(RequestOptions $request)
    {
        //Auth mandatory headers
        $this->context->authenticateRequest($request);
        //set media type headers
        $this->setMediaTypeHeaders($request);
        $request->addCustomHeader("Content-length",strlen($request->Data));
        $response = Requests::execute($request);
        return $response;
    }


    private function setMediaTypeHeaders(RequestOptions $request) {
        $request->addCustomHeader("Accept",$this->format->getMediaType());
        $request->addCustomHeader("Content-type",$this->format->getMediaType());
    }


    /**
     * Submit client request(s) to Office 365 API OData/SOAP service
     */
    public function executeQuery()
    {
        $serializer = new JsonPayloadSerializer($this->format);
        foreach ($this->queries as $qry) {
            $request = $this->buildRequest($qry);
            if(is_callable($this->eventsList["BeforeExecuteQuery"]))
                call_user_func_array($this->eventsList["BeforeExecuteQuery"],array($request,$qry));
            $response = $this->executeQueryDirect($request);
            if(empty($response))
                continue;
            if($qry->ResponsePayloadFormatType == FormatType::Json)
                $this->validateResponse($response);
            //if(is_callable($this->eventsList["AfterExecuteQuery"]))
            //    call_user_func_array($this->eventsList["AfterExecuteQuery"],array($payload));
            //populate object
            if (array_key_exists($qry->getId(), $this->resultObjects)) {
                $resultObject = $this->resultObjects[$qry->getId()];
                if ($resultObject instanceof ListItemCollection && $qry->ResponsePayloadFormatType == FormatType::Xml)
                    $resultObject->populateFromXmlPayload($response); //custom payload process
                else {
                    if ($resultObject instanceof ClientResult && $qry instanceof ClientActionInvokeMethod) {
                        $resultObject->RootPropertyName =$qry->MethodName;
                    }
                    $serializer->deserialize($response,$resultObject);
                }
            }
        }
        $this->queries = array();
    }


    public function populateObject($response,$resultObject){
        $ser = new JsonPayloadSerializer($this->format);
        $ser->deserialize($response,$resultObject);
    }

    private function validateResponse($response)
    {
        $json = JsonConvert::deserialize($response);
        if(property_exists($json,"error")){
            if(is_string($json->error->message))
                $message = $json->error->message;
            elseif (is_object($json->error->message))
                $message = $json->error->message->value;
            else
                $message = "Unknown error";
            throw new Exception($message);
        }
    }

    /**
     * @param ClientAction $query
     * @return RequestOptions
     */
    public function buildRequest(ClientAction $query)
    {
        $request = new RequestOptions($query->ResourceUrl);
        if($query->ActionType == ClientActionType::PostMethod ||
            $query->ActionType == ClientActionType::CreateEntity ||
            $query->ActionType == ClientActionType::UpdateEntity ||
            $query->ActionType == ClientActionType::DeleteEntity)
            $request->Method = HttpMethod::Post;
        //set payload
        if(!is_null($query->Payload)) {
            if(is_string($query->Payload))
                $request->Data = $query->Payload;
            else {
                $serializer = new JsonPayloadSerializer($this->format);
                $request->Data = $serializer->serialize($query->Payload);
            }
        }
        return $request;
    }



    /**
     * @param ClientObject $clientObject
     */
    function addQueryAndResultObject(ClientObject $clientObject)
    {
        $qry = new ClientActionReadEntity($clientObject->getResourceUrl());
        $this->addQuery($qry, $clientObject);
    }

}