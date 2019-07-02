<?php

use Office365\PHP\Client\SharePoint\ListTemplateType;
use Office365\PHP\Client\SharePoint\SPList;
use Office365\PHP\Client\SharePoint\ViewCreationInformation;

class ViewTest extends SharePointTestCase
{

    /**
     * @var SPList
     */
    private static $targetList;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $listTitle = ListItemExtensions::createUniqueName("Orders");
        self::$targetList = ListExtensions::ensureList(self::$context->getWeb(), $listTitle, ListTemplateType::Tasks);
    }

    public static function tearDownAfterClass()
    {
        self::$targetList->deleteObject();
        self::$context->executeQuery();
        parent::tearDownAfterClass();
    }


    public function testLoadListViews()
    {
        $views = self::$targetList->getViews();
        self::$context->load($views);
        self::$context->executeQuery();
        self::assertGreaterThan(0, $views->getCount());
    }


    public function testCreateView()
    {
        $viewCreateInfo = new ViewCreationInformation();
        $viewTitle = ListItemExtensions::createUniqueName("My Orders");
        $viewCreateInfo->Title = $viewTitle;
        self::$targetList->getViews()->add($viewCreateInfo);
        self::$context->executeQuery();


        $result = self::$targetList->getViews()->filter("Title eq '$viewTitle'");
        self::$context->load($result);
        self::$context->executeQuery();
        $this->assertEquals(1, $result->getCount());
    }


    
    

}
