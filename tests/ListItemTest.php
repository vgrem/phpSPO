<?php

use Office365\PHP\Client\SharePoint\AttachmentCreationInformation;
use Office365\PHP\Client\SharePoint\CamlQuery;
use Office365\PHP\Client\SharePoint\ListItem;
use Office365\PHP\Client\SharePoint\ListTemplateType;
use Office365\PHP\Client\SharePoint\SPList;


class ListItemTest extends SharePointTestCase
{
    /**
     * @var SPList
     */
    private static $targetList;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        $listTitle = ListItemExtensions::createUniqueName("Orders");
        self::$targetList = ListExtensions::ensureList(self::$context->getWeb(), $listTitle, ListTemplateType::Tasks);
    }

    public static function tearDownAfterClass(): void
    {
        self::$targetList->deleteObject();
        self::$context->executeQuery();
        parent::tearDownAfterClass();
    }


    public function testItemsCount()
    {
        $itemsCount = self::$targetList->getProperty("ItemCount");
        $items = self::$targetList->getItems(CamlQuery::createAllItemsQuery());
        self::$context->load($items);
        self::$context->executeQuery();
        $this->assertEquals($itemsCount, $items->getCount());
    }



    public function testCreateListItems()
    {
        $currentUser = self::$context->getWeb()->getCurrentUser();
        self::$context->load($currentUser);
        self::$context->executeQuery();
        $itemProperties = array(
            'Title' => 'Order Approval' . rand(1, 1000),
            'Body' => 'Please review a task',
            'AssignedToId' => $currentUser->getProperty("Id"),
            'PredecessorsId' => array( 'results' => array($currentUser->getProperty("Id")))
            //'__metadata' => array('type' => 'SP.Data.TasksListItem')
        );
        $items = $this->populateList($itemProperties,1);
        $firstItem = $items[0];
        $this->assertEquals($firstItem->getProperty('Body'), $itemProperties['Body']);
        return $firstItem;
    }


    /**
     * @depends testCreateListItems
     * @param ListItem $listItem
     */
    public function testAddAttachmentToListItem(ListItem $listItem)
    {
        $attCreationInformation = new AttachmentCreationInformation();
        $parentPath = basename(getcwd()) === "tests" ? "../" : "./";
        $path = "${parentPath}examples/data/attachment.txt";
        $attCreationInformation->FileName = basename($path);
        $attCreationInformation->ContentStream = file_get_contents($path);

        $attachment = $listItem->getAttachmentFiles()->add($attCreationInformation);
        self::$context->executeQuery();
        self::assertNotNull($attachment->getServerRelativeUrl());
    }


    /**
     * @depends testCreateListItems
     * @param ListItem $listItem
     */
    public function testUpdateListItems(ListItem $listItem)
    {
        self::$context->load($listItem);
        self::$context->executeQuery();

        $listItem->setProperty('PredecessorsId',array( 'results' => array($listItem->getProperty("Id"))));
        $listItem->update();
        self::$context->executeQuery();
        $predecessorsId = $listItem->getProperty("PredecessorsId");
        self::assertNotNull($predecessorsId);
    }



    public function testQueryOptionsForUserField()
    {
        $items = self::$targetList->getItems(CamlQuery::createAllItemsQuery())
            ->select("AssignedTo/Title")
            ->expand("AssignedTo");
        self::$context->load($items);
        self::$context->executeQuery();

        if($items->getCount() > 0){
            $item = $items->getItem(0);
            $assignedTo = $item->getProperty("AssignedTo");
            self::assertNotNull($assignedTo->Title);
        }
    }


    public function testQueryOptionsForMultiUserField()
    {
        $items = self::$targetList->getItems(CamlQuery::createAllItemsQuery())
            ->select("Predecessors/Title")
            ->expand("Predecessors");
        self::$context->load($items);
        self::$context->executeQuery();

        if($items->getCount() > 0){
            $item = $items->getItem(0);
            $predecessors = $item->getProperty("Predecessors");
            self::assertIsArray($predecessors);
            if(count($predecessors) > 0)
                self::assertNotNull($predecessors[0]->Title);

        }
        else{
            self::assertEmpty($items->getCount());
        }
    }


    public function testQueryOptionsSkipToken()
    {
        $minItemsCount = 10;
        $maxItemId = null;
        $itemsCount = self::$targetList->getProperty("ItemCount");
        if ($itemsCount < $minItemsCount) {
            $itemProperties = array(
                'Title' => 'Order Approval' . rand(1, 1000),
                'Body' => 'Please review a task'
            );
            $this->populateList($itemProperties, $minItemsCount - $itemsCount);
        }

        $items = self::$targetList->getItems();
        self::$context->load($items);
        self::$context->executeQuery();
        $maxItemId = max(
            array_map(function (ListItem $item) {
                return $item->getProperty("Id");
            }, $items->getData())
        );


        $items = self::$targetList->getItems()
            ->top($minItemsCount)
            ->skiptoken("Paged=TRUE&p_SortBehavior=0&p_ID=" . $maxItemId);
        self::$context->load($items);
        self::$context->executeQuery();
        $this->assertEquals(0, $items->getCount());
    }


   
    public function testDeleteListItems()
    {
        $ctx = self::$targetList->getContext();
        $items = self::$targetList->getItems(CamlQuery::createAllItemsQuery());
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


    public function populateList($itemProperties,$itemsCount)
    {
        $items = [];
        $idx = 0;
        while($idx < $itemsCount){
            $items[] = ListItemExtensions::createListItem(self::$targetList, $itemProperties);
            $idx++;
        }
        return $items;
    }
    
}
