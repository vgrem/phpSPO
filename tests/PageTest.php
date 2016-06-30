<?php

use SharePoint\PHP\Client\WebParts\PersonalizationScope;

require_once('SharePointTestCase.php');
require_once('TestUtilities.php');


class PageTest extends SharePointTestCase
{
    /**
     * @var \SharePoint\PHP\Client\File
     */
    private static $targetPage;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $pagesListFolder = self::$context->getWeb()->getLists()->getByTitle("Pages")->getRootFolder();
        self::$context->load($pagesListFolder);
        self::$context->executeQuery();


        $pageUrl = $pagesListFolder->getProperty("ServerRelativeUrl") . "/default.aspx";
        self::$targetPage = self::$context->getWeb()->getFileByServerRelativeUrl($pageUrl);
        self::$context->load(self::$targetPage);
        self::$context->executeQuery();
        //ensure whether the file is checked out to start tests
        if(self::$targetPage->getCheckOutType() == \SharePoint\PHP\Client\CheckOutType::None)
        {
            self::$targetPage->checkOut();
            self::$context->executeQuery();
        }

    }

    public static function tearDownAfterClass()
    {
        parent::tearDownAfterClass();
    }


    public function testUndoCheckoutPage(){

        self::$targetPage->undoCheckout();
        self::$context->load(self::$targetPage);
        self::$context->executeQuery();
        $this->assertEquals(\SharePoint\PHP\Client\CheckOutType::None,self::$targetPage->getCheckOutType());
    }


    public function testCheckOutPage(){
        self::$targetPage->checkOut();
        self::$context->load(self::$targetPage);
        self::$context->executeQuery();
        $this->assertEquals(\SharePoint\PHP\Client\CheckOutType::Online,self::$targetPage->getCheckOutType());
    }


    public function testCheckInPage(){
        self::$targetPage->checkIn("Modified.");
        self::$context->load(self::$targetPage);
        self::$context->executeQuery();
        $this->assertEquals(\SharePoint\PHP\Client\CheckOutType::None,self::$targetPage->getCheckOutType());
    }


    public function testListWebParts()
    {
        $manager = self::$targetPage->getLimitedWebPartManager(PersonalizationScope::Shared);
        $webParts = $manager->getWebParts();
        self::$context->load($webParts);
        self::$context->executeQuery();
        $this->assertTrue($webParts->AreItemsAvailable());
    }


    public function testAddWebPart()
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
    }



}