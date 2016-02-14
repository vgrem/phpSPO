<?php


namespace SharePoint\PHP\Client;

/**
 * Client Request.
 *
 */
class ClientRequest
{

    private $baseUrl;

    private $formDigest;

    private $headers;


	public function __construct($url, AuthenticationContext $authContext)
    {
		$this->baseUrl = $url;
		$this->authContext = $authContext;
        $this->headers = array();
        $this->addHeader($this->headers,'Accept', 'application/json; odata=verbose');
        $this->addHeader($this->headers,'Content-type', 'application/json; odata=verbose');
        $this->addHeader($this->headers,'Cookie', $authContext->getAuthenticationCookie());
    }

    public function executeQueryDirect($url,$headers,$data)
    {
        throw new \Exception("Not implemented");
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
        $data =  $query->buildData();
        $headers = $this->headers;
        $this->addHeader($headers,'Content-length', strlen($data));

        $opMethod = $query->getOperationType();
        if (!empty($data) or $query->getOperationType() != ClientOperationType::Read ) {

            if($opMethod == ClientOperationType::Update) {
                $this->addHeader($headers,'X-HTTP-Method','MERGE');
                $this->addHeader($headers,'IF-MATCH','*');
            }
            else if($opMethod == ClientOperationType::Delete) {
                $this->addHeader($headers,'X-HTTP-Method','DELETE');
                $this->addHeader($headers,'IF-MATCH','*');
            }

            if (!isset($this->formDigest)) {
                $this->requestFormDigest();
            }
            $this->addHeader($headers,'X-RequestDigest',$this->formDigest);
            $result = Requests::post($url,$headers,$data);
        }
        else {
            $result = Requests::get($url,$headers);
        }

        $result = json_decode($result);
        if (isset($result->error)) {
            throw new \RuntimeException("Error: " . $result->error->message->value);
        }
        return $result;
    }




    private function addHeader(&$headers,$key,$value)
    {
        $headers[] = $key . ':' . $value;
    }


	/**
	 * Request the Context Info
	 * @return mixed
	 */
    protected function requestFormDigest()
    {
        $url = $this->baseUrl . "/_api/contextinfo";
        $data = Requests::post($url,$this->headers);
        $json = json_decode($data);
        $this->formDigest = $json->d->GetContextWebInformation->FormDigestValue;
    }

}