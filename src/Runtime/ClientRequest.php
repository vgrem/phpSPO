<?php


namespace SharePoint\PHP\Client;


use SharePoint\PHP\Client\Runtime\ODataFormat;
use SharePoint\PHP\Client\Runtime\ODataPayloadSerializer;

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
            "BeforeExecuteRequest" => null,
            "PopulateObject" => null
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
        $this->eventsList["BeforeExecuteRequest"] = $event;
    }

    public function afterExecuteQuery(callable $event)
    {
        $this->eventsList["After"] = $event;
    }

    /**
     * @param RequestOptions $request
     * @return mixed
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
            if(is_callable($this->eventsList["BeforeExecuteRequest"]))
                call_user_func_array($this->eventsList["BeforeExecuteRequest"],array($request,$qry));
            $response = $this->executeQueryDirect($request);
            if (empty($response))
                continue;
            $this->processResponse($response, $qry);
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
        $request->PostMethod = ($query->ActionType != ClientActionType::ReadEntity);
        //set payload
        if(!is_null($query->Payload)) {
            if($query->Payload->isRawValue())
                $request->Data = $query->Payload->getValue();
            else {
                $serializer = new ODataPayloadSerializer($this->format);
                $request->Data = $serializer->serialize($query->Payload);
            }
        }
        return $request;
    }


    /**
     * @param string $response
     * @param ClientAction $query
     * @return mixed
     */
    protected function processResponse($response,ClientAction $query)
    {
        if (array_key_exists($query->getId(), $this->resultObjects)) {
            $resultObject = $this->resultObjects[$query->getId()];
            if ($resultObject instanceof ListItemCollection && $query->ResponsePayloadFormatType == FormatType::Xml)
                $resultObject->populateFromXmlPayload($response);//custom payload process
            else {
                $this->populateObject($response,$resultObject);
            }
        }
    }

    /**
     * @param string $response
     * @param ClientObject|ClientValueObject|ClientResult $resultObject
     * @param callable $onPopulate
     */
    function populateObject($response,$resultObject,callable $onPopulate = null)
    {
        $serializer = new ODataPayloadSerializer($this->format);
        $serializer->populate($response,$resultObject,$onPopulate);
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