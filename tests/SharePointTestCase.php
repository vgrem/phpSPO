<?php

require_once(__DIR__ .'/../examples/Settings.php');
require_once(__DIR__ . '/../src/ClientContext.php');
require_once(__DIR__.'/../src/auth/AuthenticationContext.php');

use SharePoint\PHP\Client\AuthenticationContext;
use SharePoint\PHP\Client\ClientContext;

abstract class SharePointTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var ClientContext
     */
    protected $context;

    public function setUp(){
        global $Settings;

        $authCtx = new AuthenticationContext($Settings['Url']);
        $authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
        $this->context = new ClientContext($Settings['Url'],$authCtx);
    }

}