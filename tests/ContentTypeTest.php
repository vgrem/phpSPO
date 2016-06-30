<?php


require_once('SharePointTestCase.php');
require_once('TestUtilities.php');


class ContentTypeTest extends SharePointTestCase
{

    public function testGetListContentTypes(){
        $listTitle = "Orders_" . rand(1, 100000);
        $list = TestUtilities::ensureList(self::$context, $listTitle, \SharePoint\PHP\Client\ListTemplateType::TasksWithTimelineAndHierarchy);
        $contentTypes = $list->getContentTypes();
        self::$context->load($contentTypes);
        self::$context->executeQuery();

        $this->assertGreaterThan(0,$contentTypes->getCount());

        TestUtilities::deleteList($list);
    }



}
