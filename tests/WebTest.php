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

    public function testWebLoad()
    {
        $web = $this->context->getWeb();
        $this->context->load($web);
        $this->context->executeQuery();
        $this->assertNotNull($web,"Web resource could not be loaded");
    }


    public function testWebCreate()
    {
        $webUrl = "Workspace_" . date("Y-m-d") . rand(1,100);

        $web = $this->context->getWeb();
        $info = new \SharePoint\PHP\Client\WebCreationInformation($webUrl,"Workspace");
        $info->WebTemplate = "STS";
        $info->UseSamePermissionsAsParentSite = false;

        $web = $web->getWebs()->add($info);
        $this->context->executeQuery();

        $this->assertNotNull($web->getProperty('Title'));

        $this->deleteWeb($web);
    }

    /**
     * Delete web operation example
     * @param \SharePoint\PHP\Client\Web $web
     */
    private function deleteWeb(SharePoint\PHP\Client\Web $web){
        $ctx = $web->getContext();
        $web->deleteObject();
        $ctx->executeQuery();
    }


    /**
     * @param \SharePoint\PHP\Client\Web $web
     * @return \SharePoint\PHP\Client\Web
     */
    private function loadWeb(SharePoint\PHP\Client\Web $web){
        $ctx = $web->getContext();
        $ctx->load($web);
        $ctx->executeQuery();
        return $web;
    }



}
