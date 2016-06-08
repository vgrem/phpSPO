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
    }

    public static function tearDownAfterClass()
    {
        parent::tearDownAfterClass();
    }



    public function testListWebParts()
    {
        $manager = self::$targetPage->getLimitedWebPartManager(PersonalizationScope::Shared);
        $webParts = $manager->getWebParts();
        self::$context->load($webParts);
        self::$context->executeQuery();

        //$this->assertEquals($folder->getProperty("ServerRelativeUrl"), $expectedFolderUrl);
    }



}