<?php


use Office365\PHP\Client\OneDrive\OneDriveClient;
use Office365\PHP\Client\Runtime\OperationParameterCollection;
use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\Auth\OAuthTokenProvider;
use Office365\PHP\Client\Runtime\Utilities\UserCredentials;


require_once(__DIR__ . '/../examples/Settings.php');
require_once(__DIR__ . '/../src/Runtime/Auth/AuthenticationContext.php');
require_once(__DIR__ . '/../src/OneDrive/OneDriveClient.php');




class OneDriveClientTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var OneDriveClient $client
     */
    private $client;

    public function setUp()
    {
        global $Settings;
        global $AppSettings;
        $authorityUrl = OAuthTokenProvider::$AuthorityUrl . $AppSettings['TenantName'];
        $authCtx = new AuthenticationContext($authorityUrl);
        //$authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
        //$authCtx->acquireTokenForUserCredential("https://graph.microsoft.com",$AppSettings['ClientId'],new UserCredentials($Settings['UserName'],$Settings['Password']));
        //$authCtx->acquireTokenForClientCredential("https://graph.microsoft.com",$AppSettings['ClientId'],$AppSettings['ClientSecret']);
        $authCtx->acquireTokenByAuthorizationCode("https://media18-my.sharepoint.com/",$AppSettings['ClientId'],$AppSettings['ClientSecret'],$AppSettings['Code'],$AppSettings['RedirectUrl']);

        //$access_token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsIng1dCI6IlliUkFRUlljRV9tb3RXVkpLSHJ3TEJiZF85cyIsImtpZCI6IlliUkFRUlljRV9tb3RXVkpLSHJ3TEJiZF85cyJ9.eyJhdWQiOiJodHRwczovL2FwaS5vZmZpY2UuY29tL2Rpc2NvdmVyeS8iLCJpc3MiOiJodHRwczovL3N0cy53aW5kb3dzLm5ldC8wYmE5ZDUyMS1jNTQxLTRhNzQtOGI2OS1mZGFiNDk0Y2JiNDgvIiwiaWF0IjoxNDc0OTAzNjg1LCJuYmYiOjE0NzQ5MDM2ODUsImV4cCI6MTQ3NDkwNzU4NSwiYWNyIjoiMSIsImFtciI6WyJwd2QiXSwiYXBwaWQiOiI1N2UzNWFiNy1hNmU1LTQwYTEtYTFlZC03OGYyZWZiYzcwODYiLCJhcHBpZGFjciI6IjEiLCJmYW1pbHlfbmFtZSI6ImN1c3RvbWVyIiwiZ2l2ZW5fbmFtZSI6InNlcnZjZXMiLCJpcGFkZHIiOiI4Mi4xODEuMzguMTY5IiwibmFtZSI6InNlcnZjZXMgY3VzdG9tZXIiLCJvaWQiOiIwN2FhZDUwMS0zZjAwLTQ5OWMtOTlhZS1jNWY2MGY5OTIxNTIiLCJwdWlkIjoiMTAwMzAwMDA5OTQ3RkU2NyIsInNjcCI6IkZpbGVzLlJlYWQgRmlsZXMuUmVhZFdyaXRlIFVzZXIuUmVhZCBVc2VyLlJlYWRXcml0ZSIsInN1YiI6IkhCdDJuYjNxX3FwSERqd0xCeTJNbHR5TE9HS2lLMFd0RUx3ZjRsSG5VQkkiLCJ0aWQiOiIwYmE5ZDUyMS1jNTQxLTRhNzQtOGI2OS1mZGFiNDk0Y2JiNDgiLCJ1bmlxdWVfbmFtZSI6InRlc3RlckBtZWRpYTE4Lm9ubWljcm9zb2Z0LmNvbSIsInVwbiI6InRlc3RlckBtZWRpYTE4Lm9ubWljcm9zb2Z0LmNvbSIsInZlciI6IjEuMCJ9.gOFqA6j9PwohGIT-_IhWP3scdipM9g5YCcu0_3_YX2e9hjHw17Ask8ZJ75FTvhee3_RgdomBdx6wXGgNTw2OaUkINsX-NCjoUoOMv7jwE1SJLXJWjEF7abDQ649coVsudpvhBpvz8fa1RKU2EaOQ5A-W71hCNQHv4a3zKzUNap_ePOi2lSyh2PSu3k6xA84nyVyaOCYuG8TBMRBL5YcAAmiS37XTLEJkU5hmmoN0riC2n6fsQBbFo7RM31LMafkQTgTauPLthggb-3n86Zn9NtPH086hRJWvGjXplV7Nug9QeKccc0FMKKiPqc-guNivqfIhB3Rdlt7tiPgtDCWS1Q";
        $this->client = new OneDriveClient("https://graph.microsoft.com",$authCtx);
    }



    public function testGetDrive()
    {
        $drive = $this->client->getMe()->getDrive();
        $this->client->load($drive);
        $this->client->executeQuery();
        self::assertNotNull($drive->getOwner());
    }


    /*public function testListFiles()
    {
        $files = $this->client->getMe()->getDrive()->getFiles();
        $this->client->load($files);
        $this->client->executeQuery();
        self::assertNotNull($files->getData());

        foreach ($files->getData() as $item){
            $url = $item->getWebUrl();
            self::assertNotNull($url);
        }
    }*/


    /*public function testCreateFolder()
    {
        $drive = $this->client->getMe()->getDrive();
        $payload = new OperationParameterCollection();
        $payload->add("name","folder123");
        $payload->add("folder",array());

        $qry = new \Office365\PHP\Client\Runtime\ClientAction($drive->getResourceUrl() . "/root/children",
            $payload,
            \Office365\PHP\Client\Runtime\ClientActionType::CreateEntity);
        $this->client->addQuery($qry);
        //$item = $files->add("test.txt","File","Welcome");
        $this->client->executeQuery();
    }*/



}
