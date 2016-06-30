<?php

require_once('SharePointTestCase.php');
require_once('TestUtilities.php');

class ListItemTest extends SharePointTestCase
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
    
    
    
    public function testItemsCount()
    {
        $itemsCount = self::$targetList->getProperty("ItemCount");
        $items = self::$targetList->getItems(\SharePoint\PHP\Client\CamlQuery::createAllItemsQuery());
        self::$context->load($items);
        self::$context->executeQuery();
        $this->assertEquals($itemsCount, $items->getCount());
    }



    public function testCreateListItems()
    {
        $itemProperties = array(
            'Title' => 'Order Approval' . rand(1, 1000),
            'Body' => 'Please review a task',
            //'__metadata' => array('type' => 'SP.Data.TasksListItem')
        );
        $item = TestUtilities::createListItem(self::$targetList, $itemProperties);
        $this->assertEquals($item->getProperty('Body'), $itemProperties['Body']);
    }


   
    public function testDeleteListItems()
    {
        $ctx = self::$targetList->getContext();
        $items = self::$targetList->getItems(\SharePoint\PHP\Client\CamlQuery::createAllItemsQuery());
        $ctx->load($items);
        $ctx->executeQuery();
        foreach ($items->getData() as $item) {
            $item->deleteObject();
            $ctx->load(self::$targetList);
            $ctx->executeQuery();
        }

        $itemsCount = self::$targetList->getProperty("ItemCount");
        $this->assertEquals($itemsCount, 0);
    }

    
}
