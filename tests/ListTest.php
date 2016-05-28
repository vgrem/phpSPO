<?php

require_once('SharePointTestCase.php');
require_once('TestUtilities.php');




class ListTest extends SharePointTestCase
{
    public function testIfListCreated()
    {
        $listTitle = "Orders_" . rand(1,1000);
        $list = TestUtilities::ensureList($this->context,$listTitle,\SharePoint\PHP\Client\ListTemplateType::Tasks);
        $this->assertEquals($list->getProperty('Title'),$listTitle);
        return $list;
    }

    /**
     * @depends testIfListCreated
     * @param \SharePoint\PHP\Client\SPList $listToDelete
     */
    public function testDeleteList(\SharePoint\PHP\Client\SPList $listToDelete)
    {
        $listToDelete->deleteObject();
        $this->context->executeQuery();
    }
}
