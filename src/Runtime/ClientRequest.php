<?php


namespace SharePoint\PHP\Client;

use SharePoint\PHP\Client\Runtime\ODataEntity;
use SharePoint\PHP\Client\Runtime\ODataFormat;
use SharePoint\PHP\Client\Runtime\ODataSerializer;

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
    private $eventList;

    /**
     * @var ClientRuntimeContext
     */
    private $context;


    /**
     * @var int
     */
    private $payloadFormatType;


    /**
     * @var ODataSerializer
     */
    private $serializer;

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
        $this->serializer = new ODataSerializer($format);
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
        $this->eventList["Before"] = $event;
    }

    public function afterExecuteQuery(callable $event)
    {
        $this->eventList["After"] = $event;
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
        $this->serializer->setMediaTypeHeaders($request);
        $response = Requests::execute($request);
        return $response;
    }


    /**
     * Submit client request(s) to Office 365 API OData/SOAP service
     */
    public function executeQuery()
    {
        foreach ($this->queries as $qry) {
            $request = $this->buildRequest($qry);
            if(is_callable($this->eventList["Before"]))
                call_user_func_array($this->eventList["Before"],array($request,$qry->ActionType));
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
            if($query->Payload instanceof FileCreationInformation)
                $request->Data = $query->Payload->Content;
            else
                $request->Data = $this->serializer->serialize($query->Payload);
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
            if ($resultObject instanceof  ListItemCollection && $query->ResponsePayloadFormatType == FormatType::Xml)
                $resultObject->processXmlPayload($response);
            else
                $this->serializer->deserialize($response, $resultObject);
        }
    }

    /**
     * @param string $response
     * @param ODataEntity $resultObject
     */
    function populateObject($response,ODataEntity $resultObject)
    {
        $this->serializer->deserialize($response,$resultObject);
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