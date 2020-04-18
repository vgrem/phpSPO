<?php

use Office365\PHP\Client\SharePoint\AttachmentCreationInformation;
use Office365\PHP\Client\SharePoint\CamlQuery;
use Office365\PHP\Client\SharePoint\Folder;
use Office365\PHP\Client\SharePoint\ListItem;
use Office365\PHP\Client\SharePoint\ListTemplateType;
use Office365\PHP\Client\SharePoint\SPList;


class ListItemTest extends SharePointTestCase
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


    public function testCreateFolderInList(){
        //ensure Folder creation is enabled for a List
        $enableFolderCreation =  self::$targetList->getProperty('EnableFolderCreation');
        if($enableFolderCreation === false){
            self::$targetList->setProperty('EnableFolderCreation',true);
            self::$targetList->update();
            self::$context->executeQuery();
        }

        $folderName = "Archive_" . rand(1, 100000);
        $folderItem = array(
            "Title" => $folderName,
            "FileLeafRef" => $folderName,
            "FileSystemObjectType" => 1,
            "ContentTypeId" => "0x0120"
        );
        $item = self::$targetList->addItem($folderItem);
        self::$context->executeQuery();
        self::assertNotNull($item->getServerObjectIsNull());
        return $item->getFolder();
    }


    /**
     * @depends testCreateFolderInList
     * @param Folder $targetFolder
     */
    public function testCamlFolderQuery($targetFolder)
    {
        self::$context->load($targetFolder);
        self::$context->executeQuery();

        $items = self::$targetList->getItems(CamlQuery::createAllFoldersQuery())->expand("Folder");
        self::$context->load($items);
        self::$context->executeQuery();
        $result = $items->findItems(function (ListItem $item) use ($targetFolder) {
            return $item->getFolder()->getProperty("Name") === $targetFolder->getProperty('Name');

        });
        self::assertNotNull($result);
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
        $items = self::populateList(self::$targetList,$itemProperties,1);
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
        $items = self::$targetList->getItems()
            ->select("AssignedTo/Title")
            ->expand("AssignedTo")
            ->filter("FSObjType eq 0");
        self::$context->load($items);
        self::$context->executeQuery();

        if($items->getCount() > 0){
            $item = $items->getItem(0);
            $assignedTo = $item->getProperty("AssignedTo");
            self::assertNotNull($assignedTo['Title']);
        }
    }


    public function testQueryOptionsForMultiUserField()
    {
        $items = self::$targetList->getItems(CamlQuery::createAllItemsQuery())
            ->select("Predecessors/Title")
            ->expand("Predecessors")
            ->filter("FSObjType eq 0");
        self::$context->load($items);
        self::$context->executeQuery();

        if($items->getCount() > 0){
            $item = $items->getItem(0);
            $predecessors = $item->getProperty("Predecessors");
            self::assertInternalType("array",$predecessors);
            if(count($predecessors) > 0)
                self::assertNotNull($predecessors[0]['Title']);

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
            self::populateList(self::$targetList,$itemProperties, $minItemsCount - $itemsCount);
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
        $items = self::$targetList->getItems();
        $ctx->load($items);
        $ctx->executeQuery();
        /** @var ListItem $item */
        foreach ($items->getData() as $item) {
            $item->deleteObject();
            $ctx->executeQuery();
        }

        $ctx->load(self::$targetList);
        $ctx->executeQuery();
        $itemsCount = self::$targetList->getProperty("ItemCount");
        $this->assertEquals($itemsCount, 0);
    }
    
}
