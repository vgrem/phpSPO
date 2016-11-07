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
        //$authCtx->acquireTokenForUserCredential("https://graph.microsoft.com",$AppSettings['ClientId'],new UserCredentials($Settings['UserName'],$Settings['Password']));
        //$authCtx->acquireTokenForClientCredential("https://graph.microsoft.com",$AppSettings['ClientId'],$AppSettings['ClientSecret']);
        //$authCtx->acquireTokenByAuthorizationCode("https://mediadev19-my.sharepoint.com/",$AppSettings['ClientId'],$AppSettings['ClientSecret'],$AppSettings['Code'],$AppSettings['RedirectUrl']);
        //$this->client = new OneDriveClient("https://graph.microsoft.com",$authCtx);
    }



    public function testGetDrive()
    {
        //$drive = $this->client->getMe()->getDrive();
        //$this->client->load($drive);
        //$this->client->executeQuery();
        //self::assertNotNull($drive->getOwner());
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
