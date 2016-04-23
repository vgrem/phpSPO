<?php


namespace SharePoint\PHP\Client;

use Exception;
use stdClass;

require_once('ClientFormatType.php');

/**
 * Client Request.
 *
 */
class ClientRequest
{

    private $baseUrl;

    private $formDigest;

    private $defaultHeaders;

    private $formatType;


	public function __construct($url, AuthenticationContext $authContext)
    {
        $this->baseUrl = $url;
        $this->authContext = $authContext;
        $this->defaultHeaders = array();
        $this->formatType = ClientFormatType::Json;
    }
    
    public function executeQueryDirect($options)
    {
        if(!empty($options["data"]) or array_key_exists('X-HTTP-Method',$options["headers"])){
            $this->ensureFormDigest();
            $options["headers"]["X-RequestDigest"] = $this->formDigest;
            $result = Requests::post($options["url"],$this->prepareHeaders($options["headers"]),$options["data"]);
        }
        else{
            $result = Requests::get($options["url"],$this->prepareHeaders($options["headers"]));
        }
        return $result;
    }

	/**
	 * Submit REST query to SharePoint REST endpoint
	 * @param ClientQuery $query
	 * @throws Exception
	 * @return mixed
	 */
    public function executeQuery(ClientQuery $query)
    {
        $options = $this->buildQuery($query);
        $result = $this->executeQueryDirect($options);
        if($query->getResponseFormatType() == ClientFormatType::Json)
            return $this->processJsonResponse($result);
        return $this->processXmlResponse($result);
    }


    function processXmlResponse($response){
        $data = new StdClass;
        $data->d->results = array();

        $xml = simplexml_load_string($response);
        $xml->registerXPathNamespace('z', '#RowsetSchema');
        $rows = $xml->xpath("//z:row");
        foreach($rows as $row) {
            $item = new StdClass;
            foreach($row->attributes() as $k => $v) {
                $normalizedFieldName = str_replace('ows_','',$k);
                $item->{$normalizedFieldName} = (string)$v;
            }
            $data->d->results[] = $item;
        }
        return $data;
    }

    private function processJsonResponse($response){
        $json = json_decode($response);
        //handle errors
        if (isset($json->error)) {
            throw new \RuntimeException("Error: " . $json->error->message->value);
        }
        return $json;
    }


    private function buildQuery(ClientQuery $query){
        $operationType = $query->getActionType();

        $requestOptions = array(
            'url' => $query->getResourceUrl(),
            'data' => $query->preparePayload(),
            'headers' => array(),
            'method' => $operationType == ClientActionType::Read ? 'GET' : 'POST'
        );
        

        if ($operationType == ClientActionType::Update) {
            $requestOptions['headers']["IF-MATCH"] = "*";
            $requestOptions['headers']["X-HTTP-Method"] = "MERGE";
        } else if ($operationType == ClientActionType::Delete) {
            $requestOptions['headers']["IF-MATCH"] = "*";
            $requestOptions['headers']["X-HTTP-Method"] = "DELETE";
        }
        return $requestOptions;
    }


    private function prepareHeaders($options)
    {
        $headers = array();
        $this->addHeader($headers, 'Cookie', $this->authContext->getAuthenticationCookie());
        $this->addHeader($headers, "Accept", "application/json; odata=verbose");
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
        $url = $this->baseUrl . "/_api/contextinfo";
        $response = Requests::post($url,$this->prepareHeaders($this->defaultHeaders));
        $json = $this->processJsonResponse($response);
        $this->formDigest = $json->d->GetContextWebInformation->FormDigestValue;
    }

}