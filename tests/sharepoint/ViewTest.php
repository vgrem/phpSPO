<?php

namespace Office365;

use Office365\SharePoint\ListTemplateType;
use Office365\SharePoint\SPList;
use Office365\SharePoint\ViewCreationInformation;

class ViewTest extends SharePointTestCase
{

    /**
     * @var SPList
     */
    private static $targetList;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $listTitle = self::createUniqueName("Orders");
        self::$targetList = self::ensureList(self::$context->getWeb(), $listTitle, ListTemplateType::Tasks);
    }

    public static function tearDownAfterClass()
    {
        self::$targetList->deleteObject()->executeQuery();
        parent::tearDownAfterClass();
    }


    public function testLoadListViews()
    {
        $views = self::$targetList->getViews()->get()->executeQuery();
        self::assertGreaterThan(0, $views->getCount());
    }


    public function testCreateView()
    {
        $viewCreateInfo = new ViewCreationInformation();
        $viewTitle = self::createUniqueName("My Orders");
        $viewCreateInfo->Title = $viewTitle;
        self::$targetList->getViews()->add($viewCreateInfo)->executeQuery();

        $result = self::$targetList->getViews()
            ->filter("Title eq '$viewTitle'")
            ->get()
            ->executeQuery();
        $this->assertEquals(1, $result->getCount());
    }

}
