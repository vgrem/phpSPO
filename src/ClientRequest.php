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
        $this->defaultHeaders['Cookie'] = $authContext->getAuthenticationCookie();
        $this->defaultHeaders["Accept"] = "application/json; odata=verbose";
        $this->defaultHeaders["Content-type"] = "application/json; odata=verbose";
    }

    public function executeQueryDirect($url,$headers=null,$data=null)
    {
        if(!isset($headers))
            $headers = $this->defaultHeaders;
        else {
            $finalHeaders = $this->defaultHeaders;
            foreach($headers as $key => $value){
                $finalHeaders[$key] = $value;
            }
            $headers = $finalHeaders;
        }

        if(!empty($data) or array_key_exists('X-HTTP-Method',$headers)){
            $this->ensureFormDigest();
            $headers["X-RequestDigest"] = $this->formDigest;
            $result = Requests::post($url,$this->prepareHeaders($headers),$data);
        }
        else{
            $result = Requests::get($url,$this->prepareHeaders($headers));
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
        $url = $query->buildUrl();
        $data = $query->buildData();
        $headers = array();
        $opMethod = $query->getOperationType();

        if ($opMethod == ClientOperationType::Update) {
            $headers["IF-MATCH"] = "*";
            $headers["X-HTTP-Method"] = "MERGE";
        } else if ($opMethod == ClientOperationType::Delete) {
            $headers["IF-MATCH"] = "*";
            $headers["X-HTTP-Method"] = "DELETE";
        }

        $result = $this->executeQueryDirect($url, $headers, $data);
        //process results
        $result = json_decode($result);
        if (isset($result->error)) {
            throw new \RuntimeException("Error: " . $result->error->message->value);
        }
        return $result;
    }


    private function prepareHeaders($headers){
        $headerLines = array();
        foreach($headers as $key => $value){
            $headerLines[] = $key . ':' . $value;
        }
        return $headerLines;
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