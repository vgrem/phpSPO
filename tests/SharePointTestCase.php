<?php

use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\SharePoint\ClientContext;


abstract class SharePointTestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ClientContext
     */
    protected static $context;

    public static function setUpBeforeClass()
    {
        global $Settings;
        global  $AppSettings;

        $authCtx = new AuthenticationContext($Settings['Url']);
        $authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
        //$authCtx->acquireTokenForApp($AppSettings['ClientId'],$AppSettings['ClientSecret'],$AppSettings['RedirectUrl']);
        self::$context = new ClientContext($Settings['Url'],$authCtx);


    }

    public static function tearDownAfterClass()
    {
        self::$context = NULL;
    }


}