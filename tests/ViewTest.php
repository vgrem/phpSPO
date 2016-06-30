<?php

require_once('SharePointTestCase.php');
require_once('TestUtilities.php');

class ViewTest extends SharePointTestCase
{

    /**
     * @var \SharePoint\PHP\Client\SPList
     */
    private static $targetList;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $listTitle = TestUtilities::createUniqueName("Orders");
        self::$targetList = TestUtilities::ensureList(self::$context, $listTitle, \SharePoint\PHP\Client\ListTemplateType::Tasks);
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
        $this->assertGreaterThan(0, $views->getCount());
    }


    
    

}
