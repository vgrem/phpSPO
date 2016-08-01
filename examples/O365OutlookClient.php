<?php


require_once(__DIR__ . '/../src/runtime/auth/NetworkCredentialContext.php');
require_once(__DIR__ . '/../src/runtime/ClientRuntimeContext.php');
require_once(__DIR__ . '/../src/runtime/utilities/RequestOptions.php');
require_once('Settings.php');


class OutlookClient extends \SharePoint\PHP\Client\ClientRuntimeContext
{
    public function __construct($loginName,$password)
    {
        $authCtx = new \SharePoint\PHP\Client\NetworkCredentialContext($loginName, $password);
        parent::__construct($this->serviceRootUrl,$authCtx);
    }

    public function getMyContacts(){

        $url = "{$this->serviceRootUrl}me/contacts";
        $options = new \SharePoint\PHP\Client\RequestOptions($url);
        //$options->addCustomHeader("Accept","application/json;odata.metadata=full;odata.streaming=true");
        $responsePayload = $this->executeQueryDirect($options);
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
     * @var string
     */
    private $serviceRootUrl = "https://outlook.office365.com/api/v1.0/";

}

global $Settings;

//Usage
$client = new OutlookClient($Settings['UserName'],$Settings['Password']);
$result = $client->getMyContacts();

print "The list of my contacts:\r\n";

if(count($result->value) == 0){
    print "No contacts have been found.";
    return;
}

foreach ($result->value as $item) {
    print $item->DisplayName;
}


