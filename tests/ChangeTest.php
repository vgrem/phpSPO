<?php

use Office365\PHP\Client\SharePoint\ChangeQuery;
use Office365\PHP\Client\SharePoint\ChangeType;



class ChangeTest extends SharePointTestCase
{
    /**
     * @var \Office365\PHP\Client\SharePoint\SPList
     */
    private static $targetList;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $listTitle = "Contacts";
        self::$targetList = ListExtensions::ensureList(self::$context->getWeb(), $listTitle, \Office365\PHP\Client\SharePoint\ListTemplateType::TasksWithTimelineAndHierarchy);
    }

    public static function tearDownAfterClass()
    {
        //self::$targetList->deleteObject();
        //self::$context->executeQuery();
        parent::tearDownAfterClass();
    }


    function testLoadListChanges()
    {
        $ctx = self::$targetList->getContext();
        $query = new ChangeQuery();
        $query->Add = true;
        $query->Update = true;
        $query->DeleteObject = true;
        $query->Item = true;
        $query->File = true;

        $changes = self::$targetList->getChanges($query);
        $ctx->executeQuery();
        $this->assertTrue($changes->AreItemsAvailable());

        foreach ($changes->getData() as $change) {
            $changeTypeName = ChangeType::getName($change->ChangeType);
            $changeName = basename(get_class($change));
            $this->assertNotNull($changeName);
            $this->assertNotNull($changeTypeName);
        }
    }


    function testLoadWebChanges(){

        $ctx = self::$targetList->getContext();
        $targetWeb = self::$targetList->getParentWeb();
        $query = new ChangeQuery();
        $query->Add = true;
        $query->Update = true;
        $query->DeleteObject = true;
        $query->Web = true;
        $query->List = true;
        $changes = $targetWeb->getChanges($query);
        $ctx->executeQuery();
        $this->assertTrue($changes->AreItemsAvailable());

        foreach ($changes->getData() as $change) {
            $changeName = basename(get_class($change));
            $changeTypeName = ChangeType::getName($change->ChangeType);
            $this->assertNotNull($changeTypeName);
            $this->assertNotNull($changeName);
        }
    }


    /*function testLoadListItemChanges()
    {
        $ctx = self::$targetList->getContext();
        $query = new ChangeLogItemQuery();
        //$query->ChangeToken = "1;3;e49a3225-13f6-47d4-a146-30d9caa05362;635969955256400000;10637059";
        $items = self::$targetList->getListItemChangesSinceToken($query);
        $ctx->executeQuery();
        $this->assertNotNull($items->getServerObjectIsNull());
        foreach ($items->getData() as $item) {
            $this->assertNotNull($item->getProperty("Title"));
        }
    }*/

}
