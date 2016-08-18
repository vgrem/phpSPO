<?php

use SharePoint\PHP\Client\ClientContext;

require_once(__DIR__ .'/../examples/Settings.php');
require_once(__DIR__ . '/../src/SharePoint/ClientContext.php');
require_once(__DIR__ . '/../src/Runtime/Auth/AuthenticationContext.php');


abstract class SharePointTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var ClientContext
     */
    protected static $context;

    public static function setUpBeforeClass()
    {
        global $Settings;
        global  $AppSettings;

        $authCtx = new \SharePoint\PHP\Client\AuthenticationContext($AppSettings['Url']);
        $authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
        //$authCtx->acquireTokenForApp($AppSettings['ClientId'],$AppSettings['ClientSecret'],$AppSettings['RedirectUrl']);
        self::$context = new ClientContext($Settings['Url'],$authCtx);


    }

    public static function tearDownAfterClass()
    {
        self::$context = NULL;
    }


}