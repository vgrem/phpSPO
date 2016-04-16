<?php


namespace SharePoint\PHP\Client;

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
        //process results
        $result = json_decode($result);
        if (isset($result->error)) {
            throw new \RuntimeException("Error: " . $result->error->message->value);
        }
        return $result;
    }




    private function buildQuery(ClientQuery $query){
        $operationType = $query->getOperationType();

        $requestOptions = array(
            'url' => $query->buildUrl(),
            'data' => $query->prepareData(),
            'headers' => array(),
            'method' => $operationType == ClientOperationType::Read ? 'GET' : 'POST'
        );

        if ($operationType == ClientOperationType::Update) {
            $requestOptions['headers']["IF-MATCH"] = "*";
            $requestOptions['headers']["X-HTTP-Method"] = "MERGE";
        } else if ($operationType == ClientOperationType::Delete) {
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
	 * @return mixed
	 */
    protected function requestFormDigest()
    {
        $url = $this->baseUrl . "/_api/contextinfo";
        $data = Requests::post($url,$this->prepareHeaders($this->defaultHeaders));
        $json = json_decode($data);
        $this->formDigest = $json->d->GetContextWebInformation->FormDigestValue;
    }

}