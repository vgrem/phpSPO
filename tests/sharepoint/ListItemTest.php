<?php

namespace Office365;

use Office365\SharePoint\AttachmentCreationInformation;
use Office365\SharePoint\CamlQuery;
use Office365\SharePoint\Folder;
use Office365\SharePoint\ListItem;
use Office365\SharePoint\ListTemplateType;
use Office365\SharePoint\SPList;


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
        self::$targetList->deleteObject()->executeQuery();
        parent::tearDownAfterClass();
    }


    public function testItemsCount()
    {
        $itemsCount = self::$targetList->getItemCount();
        $items = self::$targetList->getItems(CamlQuery::createAllItemsQuery())->executeQuery();
        $this->assertEquals($itemsCount, $items->getCount());
    }


    public function testCreateFolderInList(){
        //ensure Folder creation is enabled for a List
        $enableFolderCreation =  self::$targetList->getEnableFolderCreation();
        if($enableFolderCreation === false){
            self::$targetList->setEnableFolderCreation(true)->update()->executeQuery();
        }

        $folderName = "Archive_" . rand(1, 100000);
        $folderItem = array(
            "Title" => $folderName,
            "FileLeafRef" => $folderName,
            "FileSystemObjectType" => 1,
            "ContentTypeId" => "0x0120"
        );
        $item = self::$targetList->addItem($folderItem)->executeQuery();
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

        $items = self::$targetList->getItems()->expand("Folder")->get()->executeQuery();
        $result = $items->findItems(function (ListItem $item) use ($targetFolder) {
            return $item->getFolder()->getName() === $targetFolder->getName();

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
            'PredecessorsId' => array( 'results' => array($currentUser->getId()))
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
        $localPath = __DIR__ . "/../../examples/data/attachment.txt";
        $attCreationInformation->FileName = basename($localPath);
        $attCreationInformation->ContentStream = file_get_contents($localPath);
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

        $listItem->setProperty('PredecessorsId',array( 'results' => array($listItem->getId())));
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
        $items = self::$targetList->getItems()
            ->select("Predecessors/Title")
            ->expand("Predecessors")
            ->filter("FSObjType eq 0");
        self::$context->load($items);
        self::$context->executeQuery();

        if($items->getCount() > 0){
            $item = $items->getItem(0);
            $predecessors = $item->getProperty("Predecessors");
            self::assertNotNull($predecessors);
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
