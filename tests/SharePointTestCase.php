<?php

use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\SharePoint\ClientContext;
use PHPUnit\Framework\TestCase;


abstract class SharePointTestCase extends TestCase
{
    /**
     * @var ClientContext
     */
    protected static $context;

    public static function setUpBeforeClass() : void
    {
        $settings = include(__DIR__ . '/../Settings.php');
        $authCtx = new AuthenticationContext($settings['Url']);
        $authCtx->acquireTokenForUser($settings['UserName'],$settings['Password']);
        //$authCtx->acquireTokenForApp($AppSettings['ClientId'],$AppSettings['ClientSecret'],$AppSettings['RedirectUrl']);
        self::$context = new ClientContext($settings['Url'],$authCtx);
    }

    public static function tearDownAfterClass() : void
    {
        self::$context = NULL;
    }


}
