<?php


use Office365\PHP\Client\SharePoint\FieldType;


class FieldTest extends SharePointTestCase
{
    /**
     * @var \Office365\PHP\Client\SharePoint\SPList
     */
    private static $targetList;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $listTitle = "Contacts_" . rand(1, 100000);
        self::$targetList = TestUtilities::ensureList(self::$context->getWeb(), $listTitle, \Office365\PHP\Client\SharePoint\ListTemplateType::Contacts);
    }

    public static function tearDownAfterClass()
    {
        self::$targetList->deleteObject();
        self::$context->executeQuery();
        parent::tearDownAfterClass();
    }

    public function testReadSiteColumns()
    {
        $fields = self::$context->getSite()->getRootWeb()->getFields();
        self::$context->load($fields);
        self::$context->executeQuery();
        $this->assertNotEmpty($fields->getCount());
    }


    public function testReadListColumns()
    {
        $fields = self::$targetList->getFields();
        self::$context->load($fields);
        self::$context->executeQuery();
        $this->assertNotEmpty($fields->getCount());
    }


    public function testCreateColumn()
    {
        $fieldProperties = new \Office365\PHP\Client\SharePoint\FieldCreationInformation();
        $fieldProperties->Title =  'Contact location' . rand(1, 100);
        $fieldProperties->FieldTypeKind = FieldType::Geolocation;

        $fields = self::$context->getSite()->getRootWeb()->getFields();
        $field = $fields->add($fieldProperties);
        //self::$context->load($field);
        self::$context->executeQuery();

        $this->assertEquals($field->getProperty('Title'), $fieldProperties->Title);
        return $field;
    }


    /**
     * @depends testCreateColumn
     * @param \Office365\PHP\Client\SharePoint\Field $fieldToDelete
     */
    /*public function testDeleteColumn(\SharePoint\PHP\Client\Field $fieldToDelete)
    {
        
        $fieldId = $fieldToDelete->getProperty('Id');
        $fieldToDelete->deleteObject();
        self::$context->executeQuery();
        
        $result =  self::$context->getSite()->getRootWeb()->getFields()->filter("Id eq '$fieldId'");
        self::$context->load($result);
        self::$context->executeQuery();

        $this->assertEquals(0,$result->getCount());
    }*/


    public function testFindColumn()
    {
        $field = self::$context->getSite()->getRootWeb()->getFields()->getByInternalNameOrTitle("FileRef");
        self::$context->load($field);
        self::$context->executeQuery();
        $this->assertNotNull($field->getProperty("Title"));
    }




}
