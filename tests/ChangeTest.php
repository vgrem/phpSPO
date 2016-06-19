<?php

use SharePoint\PHP\Client\ChangeLogItemQuery;
use SharePoint\PHP\Client\ChangeQuery;
use SharePoint\PHP\Client\ChangeType;

require_once('SharePointTestCase.php');
require_once('TestUtilities.php');

class ChangeTest extends SharePointTestCase
{
    /**
     * @var \SharePoint\PHP\Client\SPList
     */
    private static $targetList;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $listTitle = "Tasks";
        self::$targetList = TestUtilities::ensureList(self::$context, $listTitle, \SharePoint\PHP\Client\ListTemplateType::TasksWithTimelineAndHierarchy);
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
            //print "Change ( {$change->Time} , {$changeTypeName} , {$change->ChangeToken->StringValue} )\r\n";
        }
    }

}
