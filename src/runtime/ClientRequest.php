<?php


namespace SharePoint\PHP\Client;
use Exception;

require_once('FormatType.php');
require_once('utilities/Requests.php');

/**
 * Client Request for OData provider.
 *
 */
class ClientRequest
{

    /**
     * @var ClientRuntimeContext
     */
    private $context;


    /**
     * @var int
     */
    private $formatType;

    /**
     * @var array
     */
    private $queries = array();

    /**
     * @var array
     */
    private $resultObjects = array();

    /**
     * ClientRequest constructor.
     * @param ClientRuntimeContext $context
     */
    public function __construct(ClientRuntimeContext $context)
    {
        $this->context = $context;
        $this->formatType = FormatType::Json;
    }


    /**
     * Add query into request queue
     * @param ClientAction $query
     * @param ClientObject $resultObject
     */
    public function addQuery(ClientAction $query, $resultObject=null)
    {
        if(isset($resultObject)){
            $queryId = $query->getId();
            $this->resultObjects[$queryId] = $resultObject;
        }
        $this->queries[] = $query;
    }

    /**
     * @param RequestOptions $options
     * @return mixed
     */
    public function executeQueryDirect(RequestOptions $options)
    {
        $this->context->authenticateRequest($options);
        if($options->PostMethod){
            if($this->context instanceof ClientContext){
                $this->context->ensureFormDigest($options);
            }
        }
        $result = Requests::execute($options);
        return $result;
    }

	/**
	 * Submit client request to SharePoint OData/SOAP service
	 * @throws Exception
	 * @return mixed
	 */
    public function executeQuery()
    {
        foreach ($this->queries as $qry) {
            $request = $this->buildRequest($qry);
            $response = array(
                "Payload" => $this->executeQueryDirect($request),
                "QueryId" => $qry->getId()
            );
            if($qry->getPayloadFormatType() == FormatType::Json){
                $this->processJsonResponse($response);
            }
            else
              $this->processXmlResponse($response);
        }
        $this->queries = array();
    }


    /**
     * Builds OData request
     * @param ClientAction $qry
     * @return RequestOptions
     */
    private function buildRequest(ClientAction $qry){
        $requestOptions = new RequestOptions($qry->getResourceUrl());
        //method
        $requestOptions->PostMethod = ($qry->ActionType != ClientActionType::ReadEntry);
        //request payload
        $requestOptions->Data = $qry->getPayload();
        //json format
        $requestOptions->setCustomHeaders($this->context->JsonFormat->buildHeaders());
        if ($qry->ActionType == ClientActionType::UpdateEntry) {
            $requestOptions->addCustomHeader("IF-MATCH","*");
            $requestOptions->addCustomHeader("X-HTTP-Method","MERGE");
        } else if ($qry->ActionType == ClientActionType::DeleteEntry) {
            $requestOptions->addCustomHeader("IF-MATCH","*");
            $requestOptions->addCustomHeader("X-HTTP-Method","DELETE");
        }
        return $requestOptions;
    }

    function addQueryAndResultObject(ClientObject $clientObject)
    {
        //if( !in_array( $clientObject ,$this->resultObjects ) ) {
            $qry = new ClientActionReadEntity($clientObject->getResourceUrl());
            $this->addQuery($qry,$clientObject);
        //}
    }

    function processXmlResponse($response){
        $queryId = $response["QueryId"];
        $resultObject = $this->resultObjects[$queryId];
        if($resultObject instanceof ListItemCollection){
            $xml = simplexml_load_string($response["Payload"]);
            $xml->registerXPathNamespace('z', '#RowsetSchema');
            $rows = $xml->xpath("//z:row");
            foreach($rows as $row) {
                $item = new ListItem($resultObject->getContext(),$resultObject->getResourcePath());
                foreach($row->attributes() as $k => $v) {
                    $normalizedFieldName = str_replace('ows_','',$k);
                    $item->setProperty($normalizedFieldName,(string)$v);
                }
                $resultObject->addChild($item);
            }
        }
    }

    private function processJsonResponse($response)
    {
        $payload = json_decode($response["Payload"]);
        if (empty($payload))
            return;

        //handle errors
        if (isset($payload->error)) {
            throw new \RuntimeException("Error: " . $payload->error->message->value);
        }

        $queryId = $response["QueryId"];
        if (array_key_exists($queryId, $this->resultObjects)) {
            $resultObject = $this->resultObjects[$queryId];
            if ($resultObject instanceof ClientObject ||
                $resultObject instanceof ClientValueObject ||
                $resultObject instanceof ClientResult) {
                $resultObject->fromJson($payload->d);
            }
        }
    }

}