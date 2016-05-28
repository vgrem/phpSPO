<?php

require_once('SharePointTestCase.php');
require_once('TestUtilities.php');

class ListItemTest extends SharePointTestCase
{
    public function testCountListItems()
    {
        $listTitle = "Orders_". rand(1,1000);
        $list = TestUtilities::ensureList($this->context,$listTitle,\SharePoint\PHP\Client\ListTemplateType::Tasks);
        $itemsCount = $list->getProperty("ItemCount");
        $items = $list->getItems(\SharePoint\PHP\Client\CamlQuery::createAllItemsQuery());
        $this->context->load($items);
        $this->context->executeQuery();
        $this->assertEquals($itemsCount,$items->getCount());
        return $list;
    }
}
