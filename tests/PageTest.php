<?php

use Office365\SharePoint\CheckOutType;
use Office365\SharePoint\File;
use Office365\SharePoint\ListTemplateType;
use Office365\SharePoint\SPList;
use Office365\SharePoint\WebParts\PersonalizationScope;

class PageTest extends SharePointTestCase
{
    /**
     * @var File
     */
    private static $targetPage;

    /**
     * @var SPList
     */
    private static $targetList;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $listTitle = self::createUniqueName("Wiki");
        self::$targetList = self::ensureList(self::$context->getWeb(),$listTitle, ListTemplateType::WebPageLibrary);
        $pageName = self::createUniqueName("Wiki") . ".aspx";
        self::$targetPage = self::createWikiPage(self::$targetList,$pageName,"Welcome to site");
        if(!self::$targetPage->isPropertyAvailable("CheckOutType")){
            self::$context->load(self::$targetPage);
            self::$context->executeQuery();
        }

        //ensure whether the file is checked out to start tests
        if(self::$targetPage->getCheckOutType() == CheckOutType::None)
        {
            self::$targetPage->checkOut();
            self::$context->executeQuery();
        }

    }

    public static function tearDownAfterClass()
    {
        self::$targetList->deleteObject();
        self::$context->executeQuery();
        parent::tearDownAfterClass();
    }


    public function testUndoCheckoutPage(){

        self::$targetPage->undoCheckout();
        self::$context->load(self::$targetPage);
        self::$context->executeQuery();
        $this->assertEquals(CheckOutType::None,self::$targetPage->getCheckOutType());
    }


    public function testCheckOutPage(){
        self::$targetPage->checkOut();
        self::$context->load(self::$targetPage);
        self::$context->executeQuery();
        $this->assertEquals(CheckOutType::Online,self::$targetPage->getCheckOutType());
    }


    public function testCheckInPage(){
        self::$targetPage->checkIn("Modified.");
        self::$context->load(self::$targetPage);
        self::$context->executeQuery();
        $this->assertEquals(CheckOutType::None,self::$targetPage->getCheckOutType());
    }


    public function testListWebParts()
    {
        $manager = self::$targetPage->getLimitedWebPartManager(PersonalizationScope::Shared);
        $webParts = $manager->getWebParts();
        self::$context->load($webParts);
        self::$context->executeQuery();
        $this->assertNotNull($webParts->getServerObjectIsNull());
    }


    /*public function testAddWebPart()
    {
        $webPartXml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
"<WebPart xmlns=\"http://schemas.microsoft.com/WebPart/v2\">" .
    "<Assembly>Microsoft.SharePoint, Version=16.0.0.0, Culture=neutral, PublicKeyToken=71e9bce111e9429c</Assembly>" .
    "<TypeName>Microsoft.SharePoint.WebPartPages.ContentEditorWebPart</TypeName>" .
    "<Title>\$Resources:core,ContentEd itorWebPartTitle;</Title>" .
    "<Description>\$Resources:core,ContentEditorWebPartDescription;</Description>" .
    "<PartImageLarge>/_layouts/15/images/mscontl.gif</PartImageLarge>" .
"</WebPart>";

        
        $manager = self::$targetPage->getLimitedWebPartManager(PersonalizationScope::Shared);
        $webPartDef = $manager->importWebPart($webPartXml);
        self::$context->executeQuery();
        $type = $webPartDef->getEntityTypeName();
        $this->assertEquals($type, "SP.WebParts.WebPartDefinition");
    }*/



}
