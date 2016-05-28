<?php

require_once('SharePointTestCase.php');
require_once('TestUtilities.php');




class ListTest extends SharePointTestCase
{
    public function testIfListCreated()
    {
        $listTitle = "Orders_" . rand(1,100000);
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
        $listId = $listToDelete->getProperty('Id');
        $ctx = $listToDelete->getContext();
        $lists = $ctx->getWeb()->getLists();
        $ctx->load($lists);
        $ctx->executeQuery();

        $listsCount = $lists->getCount();
        $result = array_filter(
            $lists->getData(),
            function ($l) use ($listId) {
                return $l->getProperty('Id') == $listId;
            }
        );

        if(count($result)  == 1){
            $listToDelete->deleteObject();
            $ctx->load($lists);
            $ctx->executeQuery();
        }
        
        
    }
}
