<?php

require_once(__DIR__ .'/../examples/Settings.php');
require_once(__DIR__ . '/../src/ClientContext.php');
require_once(__DIR__.'/../src/auth/AuthenticationContext.php');

use SharePoint\PHP\Client\AuthenticationContext;
use SharePoint\PHP\Client\ClientContext;




class WebTest extends PHPUnit_Framework_TestCase
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


    public function testCreateWeb()
    {
        $targetWebUrl = "Workspace_" . date("Y-m-d") . rand(1,10000);
        $targetWeb = $this->createWeb($targetWebUrl);
        $this->assertEquals($targetWeb->getProperty('Url'),$this->context->getUrl() . $targetWebUrl);
        return $targetWeb;
    }

    /**
     * @depends testCreateWeb
     * @param \SharePoint\PHP\Client\Web $targetWeb
     * @return \SharePoint\PHP\Client\Web
     */
    public function testIfWebExist(\SharePoint\PHP\Client\Web $targetWeb)
    {
        $ctx = $targetWeb->getContext();
        $webTitle = $targetWeb->getProperty('Title');
        $webs = $ctx->getWeb()->getWebs()->filter("Title eq '$webTitle'");
        $ctx->load($webs);
        $ctx->executeQuery();
        $this->assertCount(1,$webs->getData());
        return $targetWeb;
    }

    /**
     * @depends testCreateWeb
     * @param \SharePoint\PHP\Client\Web $targetWeb
     */
    public function testTryDeleteWeb(\SharePoint\PHP\Client\Web $targetWeb){
        $ctx = $targetWeb->getContext();
        $targetWeb->deleteObject();
        $ctx->executeQuery();
    }

    private function createWeb($webUrl)
    {
        $web = $this->context->getWeb();
        $info = new \SharePoint\PHP\Client\WebCreationInformation($webUrl,$webUrl);
        $web = $web->getWebs()->add($info);
        $this->context->executeQuery();
        return $web;
    }
}
