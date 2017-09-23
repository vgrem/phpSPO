<?php


class ContentTypeTest extends SharePointTestCase
{

    public function testGetListContentTypes(){
        $listTitle = ListItemExtensions::createUniqueName("Orders");
        $list = ListExtensions::ensureList(self::$context->getWeb(), $listTitle, \Office365\PHP\Client\SharePoint\ListTemplateType::TasksWithTimelineAndHierarchy);
        $contentTypes = $list->getContentTypes();
        self::$context->load($contentTypes);
        self::$context->executeQuery();

        $this->assertGreaterThan(0,$contentTypes->getCount());

        ListExtensions::deleteList($list);
    }


    public function testFindContentType(){
        $results = self::$context->getSite()->getRootWeb()->getContentTypes()->filter("StringId eq '0x0101'");
        self::$context->load($results);
        self::$context->executeQuery();
        $this->assertEquals(1,$results->getCount());
    }



    public function testGetContentTypeById(){
        $ctId = "0x0101";
        $ct = self::$context->getSite()->getRootWeb()->getContentTypes()->getById($ctId);
        self::$context->load($ct);
        self::$context->executeQuery();
        $this->assertEquals($ctId,$ct->getProperty("StringId"));
    }


    public function testCreateContentType(){
        $params = new \Office365\PHP\Client\SharePoint\ContentTypeCreationInformation();
        $params->Name = ListItemExtensions::createUniqueName("Custom Task");
        //$params->setParentId("0x0108");
        $ct = self::$context->getSite()->getRootWeb()->getContentTypes()->add($params);
        self::$context->executeQuery();
        $this->assertNotNull($ct->getProperty("StringId"));
        return $ct;
    }


    /**
     * @depends testCreateContentType
     * @param \Office365\PHP\Client\SharePoint\ContentType $ct
     */
    public function testDeleteContentType(\Office365\PHP\Client\SharePoint\ContentType $ct){
        $ctId = $ct->getProperty("StringId");
        $ct->deleteObject();
        self::$context->executeQuery();

        $results = self::$context->getSite()->getRootWeb()->getContentTypes()->filter("StringId eq '" . $ctId . "'");
        self::$context->load($results);
        self::$context->executeQuery();
        $this->assertEquals(0,$results->getCount());
    }
}
