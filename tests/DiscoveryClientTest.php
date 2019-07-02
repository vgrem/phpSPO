<?php


namespace Office365\PHP\Client\Discovery;


use Office365\PHP\Client\Runtime\Auth\NetworkCredentialContext;
use PHPUnit\Framework\TestCase;

class DiscoveryClientTest extends TestCase
{

    /**
     * @var DiscoveryClient
     */
    protected static $client;

    public static function setUpBeforeClass()
    {
        $Settings = include(__DIR__ . '/../Settings.php');
        $authCtx = new NetworkCredentialContext($Settings["UserName"],$Settings["Password"]);
        self::$client = new DiscoveryClient($authCtx);
    }




    public function testGetAllServices()
    {
        $result = self::$client->getAllServices();
        self::$client->executeQuery();
        self::assertNotEmpty($result->getCount());

        foreach ($result->getData() as $info) {
            $this->assertNotNull($info->serviceName);
        }
    }

}
