<?php

require_once(__DIR__ .'/../examples/Settings.php');
require_once(__DIR__ . '/../src/ClientContext.php');
require_once(__DIR__.'/../src/auth/AuthenticationContext.php');

use SharePoint\PHP\Client\AuthenticationContext;
use SharePoint\PHP\Client\ClientContext;




class SiteTest extends PHPUnit_Framework_TestCase
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

    public function testIfSiteLoaded()
    {
        $site = $this->context->getSite();
        $this->context->load($site);
        $this->context->executeQuery();
        $this->assertNotNull($site,"Site resource could not be loaded");
    }

}
