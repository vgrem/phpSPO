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

    private $defaultHeaders;


	public function __construct($url, AuthenticationContext $authContext)
    {
		$this->baseUrl = $url;
		$this->authContext = $authContext;
        $this->defaultHeaders = array();
        $this->addHeader($this->defaultHeaders,'Accept', 'application/json; odata=verbose');
        $this->addHeader($this->defaultHeaders,'Content-type', 'application/json; odata=verbose');
        $this->addHeader($this->defaultHeaders,'Cookie', $authContext->getAuthenticationCookie());
    }

    public function executeQueryDirect($url,$headers=null,$data=null)
    {
        if(!isset($headers))
            $headers = $this->defaultHeaders;
        else {
            $headers_local = $this->defaultHeaders;
            foreach($headers as $key => $value){
                $this->addHeader($headers_local,$key, $value);
            }
            $headers = $headers_local;
        }

        if(!empty($data) or array_key_exists('X-HTTP-Method',$headers)){
            if (!isset($this->formDigest)) {
                $this->requestFormDigest();
            }
            $this->addHeader($headers,'X-RequestDigest',$this->formDigest);
            $dataJson = ($data != null ? json_encode($data) : '');
            $result = Requests::post($url,$headers,$dataJson);
        }
        else{
            $result = Requests::get($url,$headers);
        }

        $result = json_decode($result);
        if (isset($result->error)) {
            throw new \RuntimeException("Error: " . $result->error->message->value);
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
        $data =  $query->buildData();
        $headers = $this->defaultHeaders;
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

            $this->ensureFormDigest();
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
        $data = Requests::post($url,$this->defaultHeaders);
        $json = json_decode($data);
        $this->formDigest = $json->d->GetContextWebInformation->FormDigestValue;
    }

}