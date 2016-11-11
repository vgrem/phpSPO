<?php

use Office365\PHP\Client\OutlookServices\OutlookClient;
use Office365\PHP\Client\Runtime\Auth\NetworkCredentialContext;



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