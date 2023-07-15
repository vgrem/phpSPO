<?php

namespace Office365;


use Office365\SharePoint\DocumentManagement\DocumentSet\DocumentSet;

class DocSetTest extends SharePointTestCase
{

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
    }


    public function testCreate(){
        $lib = self::$context->getWeb()->defaultDocumentLibrary()->get()->executeQuery();
        $this->assertNotNull($lib->getResourcePath());
        $name = "DocSet_" . rand(1, 100000);
        $returnType = DocumentSet::create(self::$context,$lib->getRootFolder(), $name)->executeQuery();
        $this->assertNotNull($returnType->getResourcePath());
        return $returnType;
    }

    /**
     * @depends testCreate
     * @param DocumentSet $docSet
     */
    public function testDelete($docSet){
        $docSet->deleteObject()->executeQuery();

        $result = $docSet->get()->select(["Exists"])->executeQuery();
        $this->assertFalse($result->getProperty("Exists"));
    }

}
