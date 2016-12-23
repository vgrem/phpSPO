<?php


namespace Office365\PHP\Client\Discovery;


use Office365\PHP\Client\Runtime\Auth\NetworkCredentialContext;

class DiscoveryClientTest extends \PHPUnit_Framework_TestCase
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

    public function testDiscoverCapabilities()
    {
        $result = self::$client->getDiscoverCapabilities();
        self::assertNotNull($result);

    }

}
