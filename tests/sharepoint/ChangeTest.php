<?php

namespace Office365;

use Office365\SharePoint\Change;
use Office365\SharePoint\ChangeQuery;
use Office365\SharePoint\ChangeType;
use Office365\SharePoint\ListTemplateType;
use Office365\SharePoint\SPList;


class ChangeTest extends SharePointTestCase
{
    /**
     * @var SPList
     */
    private static $targetList;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $listTitle = "Contacts";
        self::$targetList = self::ensureList(self::$context->getWeb(), $listTitle, ListTemplateType::TasksWithTimelineAndHierarchy);

        $contactEntry = array('Title' => "New contact");
        self::$targetList->addItem($contactEntry)->executeQuery();
    }

    public static function tearDownAfterClass()
    {
        self::$targetList->deleteObject()->executeQuery();
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

        $changes = self::$targetList->getChanges($query)->executeQuery();
        $this->assertFalse($changes->getServerObjectIsNull());

        /** @var Change  $change */
        foreach ($changes->getData() as $change) {
            $changeTypeName = ChangeType::getName($change->getChangeType());
            $changeName = basename(get_class($change));
            $this->assertNotNull($changeName);
            $this->assertNotNull($changeTypeName);
        }
    }


    function testLoadWebChanges(){
        $targetWeb = self::$targetList->getParentWeb();
        $query = new ChangeQuery();
        $query->Add = true;
        $query->Update = true;
        $query->DeleteObject = true;
        $query->Web = true;
        $query->List = true;
        $changes = $targetWeb->getChanges($query)->executeQuery();
        $this->assertFalse($changes->getServerObjectIsNull());

        /** @var Change  $change */
        foreach ($changes->getData() as $change) {
            $changeName = basename(get_class($change));
            $changeTypeName = ChangeType::getName($change->getChangeType());
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
