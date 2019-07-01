<?php

use Office365\PHP\Client\SharePoint\ChangeQuery;
use Office365\PHP\Client\SharePoint\ChangeType;
use Office365\PHP\Client\SharePoint\ListTemplateType;
use Office365\PHP\Client\SharePoint\SPList;


class ChangeTest extends SharePointTestCase
{
    /**
     * @var SPList
     */
    private static $targetList;

    public static function setUpBeforeClass() : void
    {
        parent::setUpBeforeClass();
        $listTitle = "Contacts";
        self::$targetList = ListExtensions::ensureList(self::$context->getWeb(), $listTitle, ListTemplateType::TasksWithTimelineAndHierarchy);

        $contactEntry = array('Title' => "New contact");
        self::$targetList->addItem($contactEntry);
        self::$context->executeQuery();
    }

    public static function tearDownAfterClass() : void
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
        $this->assertFalse($changes->getServerObjectIsNull());

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
        $this->assertFalse($changes->getServerObjectIsNull());

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
