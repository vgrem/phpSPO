<?php


namespace SharePoint\PHP\Client;

use Exception;
use SharePoint\PHP\Client\Runtime\ContextWebInformation;


require_once('FormatType.php');

/**
 * Client Request for OData provider.
 *
 */
class ClientRequest
{

    /**
     * @var ClientContext
     */
    private $context;

    /**
     * @var ContextWebInformation
     */
    private $contextWebInformation;

    /**
     * @var array
     */
    private $defaultHeaders;

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
     * @param ClientContext $context
     */
    public function __construct(ClientContext $context)
    {
        $this->context = $context;
        $this->defaultHeaders = array(
            "Accept" => "application/json; odata=verbose",
            "Content-type" => "application/json; odata=verbose"
        );
        $this->formatType = FormatType::Json;
    }

    public static function create($url, AuthenticationContext $authContext) {
        $ctx = new ClientContext($url,$authContext);
        return new ClientRequest($ctx);
    }



    public function addQuery(ClientAction $query, $resultObject=null)
    {
        if(isset($resultObject)){
            $queryId = $query->getId();
            $this->resultObjects[$queryId] = $resultObject;
        }
        $this->queries[] = $query;
    }

    
    public function executeQueryDirect(RequestOptions $options)
    {
        $this->context->authenticateRequest($options);
        $options->setCustomHeaders($this->defaultHeaders);
        if($options->PostMethod){
            $this->ensureFormDigest();
            $options->addCustomHeader("X-RequestDigest",$this->contextWebInformation->FormDigestValue);
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
        $requestOptions->PostMethod = ($qry->ActionType != ClientActionType::ReadEntry);
        $requestOptions->Data = $qry->getPayload();

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

    /**
     * Ensure form digest value for POST request
     */
    protected function ensureFormDigest()
    {
        if (!isset($this->formDigest)) {
            $this->requestFormDigest();
        }
    }


	/**
	 * Request the Context Info
	 */
    protected function requestFormDigest()
    {
        $url = $this->context->getUrl() . "/_api/contextinfo";
        $request = new RequestOptions($url);
        $request->Headers = $this->defaultHeaders;
        $request->PostMethod = true;
        //authenticate request
        $this->context->authenticateRequest($request);
        $response = Requests::execute($request);
        $data = json_decode($response);
        $this->contextWebInformation = new ContextWebInformation();
        $this->contextWebInformation->fromJson($data);
    }

}