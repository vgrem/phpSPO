<?php


namespace Office365\PHP\Client\Discovery;


use Office365\PHP\Client\Runtime\Auth\NetworkCredentialContext;

class DiscoveryClientTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var DiscoveryClient
     */
    protected static $client;

    public static function setUpBeforeClass()
    {
        global $Settings;
        $authCtx = new NetworkCredentialContext($Settings["UserName"],$Settings["Password"]);
        self::$client = new DiscoveryClient($authCtx);
    }




    public function testGetAllServices()
    {
        $result = self::$client->getAllServices();
        self::$client->executeQuery();
        self::assertNotEmpty($result->getCount());

        foreach ($result->getData() as $info) {
            $this->assertNotNull($info->serviceId);
        }
    }

}
