<?php


require_once(__DIR__ . '/../src/runtime/auth/BasicAuthenticationContext.php');
require_once(__DIR__ . '/../src/runtime/auth/NtlmAuthenticationContext.php');
require_once(__DIR__ . '/../src/ClientContext.php');
require_once('Settings.php');


class OutlookClient
{

    public function __construct($loginName,$password)
    {
        $this->authCtx = new \SharePoint\PHP\Client\BasicAuthenticationContext($this->serviceRootUrl, $loginName, $password);
    }


    public function getMyContacts(){
        $request = \SharePoint\PHP\Client\ClientRequest::create($this->serviceRootUrl,$this->authCtx);

        $url = "{$this->serviceRootUrl}me/contacts";
        $options = new \SharePoint\PHP\Client\RequestOptions($url);
        $options->addCustomHeader("Accept","application/json;odata.metadata=full;odata.streaming=true");
        $responsePayload = $request->executeQueryDirect($options);
        return $this->processResponsePayload($responsePayload);
    }


    private function processResponsePayload($response){
        if(empty($response)){
           return null;
        }
        $payload = json_decode($response);
        //validate for errors
        //...
        return $payload;
    }


    /**
     * @var \SharePoint\PHP\Client\AuthenticationContext
     */
    private $authCtx;

    /**
     * @var string
     */
    private $serviceRootUrl = "https://outlook.office365.com/api/v1.0/";

}


//Usage
$client = new OutlookClient($Settings['UserName'],$Settings['Password']);
$result = $client->getMyContacts();

print "The list of my contacts:\r\n";
foreach ($result->value as $item) {
    print $item->DisplayName;
}


