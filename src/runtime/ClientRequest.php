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
        $this->defaultHeaders = array();
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

    
    public function executeQueryDirect($options)
    {
        if (!isset($options["headers"])) {
            $options["headers"] = [];
        }
        if (!isset($options["method"])) {
            $options["method"] = "GET";
        }

        $this->context->authenticateRequest($options);
        
        //if(!empty($options["data"]) or array_key_exists('X-HTTP-Method',$options["headers"])){
        if(!empty($options["data"]) or $options["method"] == "POST"){
            $this->ensureFormDigest();
            $options["headers"]["X-RequestDigest"] = $this->contextWebInformation->FormDigestValue;
            $result = Requests::post($options["url"],$this->prepareHeaders($options["headers"]),$options["data"]);
        }
        else{
            $result = Requests::get($options["url"],$this->prepareHeaders($options["headers"]));
        }
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
                "Result" => $this->executeQueryDirect($request),
                "QueryId" => $qry->getId()
            );
            if($qry->getDataFormatType() == FormatType::Json){
                $this->processJsonResponse($response);
            }
            else
              $this->processXmlResponse($response);
        }
        $this->queries = array();
    }


    private function buildRequest(ClientAction $qry){
        $operationType = $qry->getMethodType();

        $requestOptions = array(
            'url' =>  $qry->getResourceUrl(),
            'headers' => array(),
            'data' => null,
            'method' => $operationType == HttpMethod::Get ? 'GET' : 'POST'
        );

        $data = $qry->getData();
        if(isset($data)){
            $requestOptions["data"] = $data;
        }

        if ($operationType == HttpMethod::Merge) {
            $requestOptions['headers']["IF-MATCH"] = "*";
            $requestOptions['headers']["X-HTTP-Method"] = "MERGE";
        } else if ($operationType == HttpMethod::Delete) {
            $requestOptions['headers']["IF-MATCH"] = "*";
            $requestOptions['headers']["X-HTTP-Method"] = "DELETE";
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
            $xml = simplexml_load_string($response["Result"]);
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
        $content = json_decode($response["Result"]);
        if (empty($content))
            return;

        //handle errors
        if (isset($content->error)) {
            throw new \RuntimeException("Error: " . $content->error->message->value);
        }

        $queryId = $response["QueryId"];
        if (array_key_exists($queryId, $this->resultObjects)) {
            $resultObject = $this->resultObjects[$queryId];
            if ($resultObject instanceof ClientObject ||
                $resultObject instanceof ClientValueObject ||
                $resultObject instanceof ClientResult) {
                $resultObject->fromJson($content->d);
            }
        }
    }

    private function prepareHeaders($options)
    {
        $headers = array();

        if (!array_key_exists('Accept', $options))
            $this->addHeader($headers, "Accept", "application/json; odata=verbose");
        if (!array_key_exists('Content-type', $options))
            $this->addHeader($headers, "Content-type", "application/json; odata=verbose");
        
        foreach ($options as $key => $value) {
            $this->addHeader($headers, $key, $value);
        }
        
        return $headers;
    }

    private function addHeader(&$headers,$key,$value)
    {
        $headers[] = $key . ':' . $value;
    }



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
        $options = array(
            'url' => $this->context->getUrl() . "/_api/contextinfo",
            'headers' => $this->defaultHeaders
        );
        //authenticate request
        $this->context->authenticateRequest($options);

        $content = Requests::post($options['url'],$this->prepareHeaders($options['headers']));
        $data = json_decode($content);
        $this->contextWebInformation = new ContextWebInformation();
        $this->contextWebInformation->fromJson($data);
    }

}