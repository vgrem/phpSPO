<?php

require_once('SharePointTestCase.php');
require_once('TestUtilities.php');




class ListTest extends SharePointTestCase
{
    public function testIfListCreated()
    {
        $listTitle = "Orders_" . rand(1,100000);
        $list = TestUtilities::ensureList(self::$context,$listTitle,\SharePoint\PHP\Client\ListTemplateType::Tasks);
        $this->assertEquals($list->getProperty('Title'),$listTitle);
        return $list;
    }

    /**
     * @depends testIfListCreated
     * @param \SharePoint\PHP\Client\SPList $listToDelete
     */
    public function testDeleteList(\SharePoint\PHP\Client\SPList $listToDelete)
    {
        $ctx = $listToDelete->getContext();
        $listId = $listToDelete->getProperty('Id');
        $listToDelete->deleteObject();
        $ctx->executeQuery();

        
        /*$result = array_filter(
            $lists->getData(),
            function ($l) use ($listId) {
                return $l->getProperty('Id') == $listId;
            }
        );*/

        $result =  $ctx->getWeb()->getLists()->filter("Id eq '$listId'");
        $ctx->load($result);
        $ctx->executeQuery();

        $this->assertEquals(0,$result->getCount());
    }
}
