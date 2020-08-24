<?php

namespace Office365;

use Office365\SharePoint\ContentType;
use Office365\SharePoint\ContentTypeCreationInformation;
use Office365\SharePoint\ListTemplateType;

class ContentTypeTest extends SharePointTestCase
{

    public function testGetListContentTypes(){
        $listTitle = self::createUniqueName("Orders");
        $list = self::ensureList(self::$context->getWeb(), $listTitle, ListTemplateType::TasksWithTimelineAndHierarchy);
        $contentTypes = $list->getContentTypes();
        self::$context->load($contentTypes);
        self::$context->executeQuery();
        $this->assertGreaterThan(0,$contentTypes->getCount());

        $list->deleteObject()->executeQuery();
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
        $params = new ContentTypeCreationInformation();
        $params->Name = self::createUniqueName("Custom Task");
        //$params->setParentId("0x0108");
        $ct = self::$context->getSite()->getRootWeb()->getContentTypes()->add($params);
        self::$context->executeQuery();
        $this->assertNotNull($ct->getProperty("StringId"));
        return $ct;
    }


    /**
     * @depends testCreateContentType
     * @param ContentType $ct
     */
    public function testDeleteContentType(ContentType $ct){
        $ctId = $ct->getProperty("StringId");
        $ct->deleteObject();
        self::$context->executeQuery();

        $results = self::$context->getSite()->getRootWeb()->getContentTypes()->filter("StringId eq '" . $ctId . "'");
        self::$context->load($results);
        self::$context->executeQuery();
        $this->assertEquals(0,$results->getCount());
    }
}
