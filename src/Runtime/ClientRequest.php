<?php


namespace Office365\PHP\Client\Runtime;


use Office365\PHP\Client\Runtime\OData\ODataFormat;
use Office365\PHP\Client\Runtime\OData\ODataMetadataLevel;
use Office365\PHP\Client\Runtime\OData\ODataPayload;
use Office365\PHP\Client\Runtime\OData\JsonPayloadSerializer;
use Office365\PHP\Client\Runtime\OData\ODataPayloadKind;
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
        foreach ($this->queries as $qry) {
            $request = $this->buildRequest($qry);
            if(is_callable($this->eventsList["BeforeExecuteQuery"]))
                call_user_func_array($this->eventsList["BeforeExecuteQuery"],array($request,$qry));
            $response = $this->executeQueryDirect($request);
            if(empty($response))
                continue;
            //if(is_callable($this->eventsList["AfterExecuteQuery"]))
            //    call_user_func_array($this->eventsList["AfterExecuteQuery"],array($payload));
            //populate object
            if (array_key_exists($qry->getId(), $this->resultObjects)) {
                $resultObject = $this->resultObjects[$qry->getId()];
                if ($resultObject instanceof ListItemCollection && $qry->ResponsePayloadFormatType == FormatType::Xml)
                    $resultObject->populateFromXmlPayload($response); //custom payload process
                else {
                    $serializer = new JsonPayloadSerializer($this->format);
                    $responsePayload = $serializer->deserialize($response);
                    if ($resultObject instanceof ClientResult && $qry instanceof ClientActionInvokeMethod) {
                        $responsePayload->ContainerName = $qry->MethodName;
                        $responsePayload->PayloadType = ODataPayloadKind::Parameter;
                    }
                    $serializer->populate($responsePayload, $resultObject);
                }
            }
        }
        $this->queries = array();
    }



    /**
     * @param ClientAction $query
     * @return RequestOptions
     */
    public function buildRequest(ClientAction $query)
    {
        $request = new RequestOptions($query->ResourceUrl);
        $request->PostMethod = ($query->ActionType != ClientActionType::Get);
        //set payload
        if(!is_null($query->Payload)) {
            if($query->Payload->isRawValue())
                $request->Data = $query->Payload->Value;
            else {
                $serializer = new JsonPayloadSerializer($this->format);
                $request->Data = $serializer->serialize($query->Payload);
            }
        }
        return $request;
    }


    /**
     * @param ODataPayload $responsePayload
     * @param ClientObject|ClientValueObject $resultObject
     */
    public function populateObject(ODataPayload $responsePayload,$resultObject)
    {
        $serializer = new JsonPayloadSerializer($this->format);
        $serializer->populate($responsePayload, $resultObject);
    }




    private function validateResponsePayload(ODataPayload $payload){
        if($this->format->isJson() && $this->format->MetadataLevel == ODataMetadataLevel::Verbose){
            //if(property_exists($payload->Value,"error")){
            //}
        }
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