<?php

use Office365\PHP\Client\OutlookServices\OutlookClient;
use Office365\PHP\Client\Runtime\Auth\NetworkCredentialContext;



require_once(__DIR__ .'/../examples/Settings.php');
require_once(__DIR__ . '/../src/Runtime/Auth/NetworkCredentialContext.php');
require_once(__DIR__ . '/../src/OutlookServices/OutlookClient.php');


abstract class OutlookServicesTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var OutlookClient
     */
    protected static $context;


    public static function setUpBeforeClass()
    {
        global $Settings;
        $authCtx = new NetworkCredentialContext($Settings["UserName"],$Settings["Password"]);
        self::$context = new OutlookClient($authCtx);
    }

    public static function tearDownAfterClass()
    {
        self::$context = NULL;
    }


}