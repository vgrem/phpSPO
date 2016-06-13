<?php

require_once(__DIR__ .'/../examples/Settings.php');
require_once(__DIR__ . '/../src/ClientContext.php');
require_once(__DIR__ . '/../src/runtime/auth/AuthenticationContext.php');

use SharePoint\PHP\Client\AuthenticationContext;
use SharePoint\PHP\Client\ClientContext;

abstract class SharePointTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var ClientContext
     */
    protected static $context;

    public static function setUpBeforeClass()
    {
        global $Settings;

        $authCtx = new AuthenticationContext($Settings['Url']);
        $authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
        self::$context = new ClientContext($Settings['Url'],$authCtx);
    }

    public static function tearDownAfterClass()
    {
        self::$context = NULL;
    }


}