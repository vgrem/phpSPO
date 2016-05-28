<?php

require_once('SharePointTestCase.php');
require_once('TestUtilities.php');

class ListItemTest extends SharePointTestCase
{
    public function testIfListReady()
    {
        $listTitle = "Orders_" . rand(1, 100000);
        $list = TestUtilities::ensureList($this->context, $listTitle, \SharePoint\PHP\Client\ListTemplateType::Tasks);
        $itemsCount = $list->getProperty("ItemCount");
        $items = $list->getItems(\SharePoint\PHP\Client\CamlQuery::createAllItemsQuery());
        $this->context->load($items);
        $this->context->executeQuery();
        $this->assertEquals($itemsCount, $items->getCount());
        return $list;
    }


    /**
     * @depends testIfListReady
     * @param \SharePoint\PHP\Client\SPList $list
     */
    public function testCreateListItems(\SharePoint\PHP\Client\SPList $list)
    {
        //$ctx = $list->getContext();
        $itemProperties = array(
            'Title' => 'Order Approval' . rand(1, 1000),
            'Body' => 'Please review a task',
            //'__metadata' => array('type' => 'SP.Data.TasksListItem')
        );
        $item = TestUtilities::createListItem($list, $itemProperties);
        $this->assertEquals($item->getProperty('Body'), $itemProperties['Body']);
    }


    /**
     * @depends testIfListReady
     * @param \SharePoint\PHP\Client\SPList $list
     */
    public function testDeleteListItems(\SharePoint\PHP\Client\SPList $list)
    {
        $ctx = $list->getContext();
        $items = $list->getItems(\SharePoint\PHP\Client\CamlQuery::createAllItemsQuery());
        $ctx->load($items);
        $ctx->executeQuery();
        foreach ($items->getData() as $item) {
            $item->deleteObject();
            $ctx->load($list);
            $ctx->executeQuery();
        }

        $itemsCount = $list->getProperty("ItemCount");
        $this->assertEquals($itemsCount, 0);
    }

    /**
     * @depends testIfListReady
     * @param \SharePoint\PHP\Client\SPList $listToDelete
     */
    public function testDeleteList(\SharePoint\PHP\Client\SPList $listToDelete)
    {
        $listId = $listToDelete->getProperty('Id');
        $ctx = $listToDelete->getContext();
        $lists = $ctx->getWeb()->getLists();
        $listToDelete->deleteObject();
        $ctx->load($lists);
        $ctx->executeQuery();

        $result = array_filter(
            $lists->getData(),
            function ($l) use ($listId) {
                return $l->getProperty('Id') == $listId;
            }
        );

        $this->assertEquals(0,count($result));
    }
}
