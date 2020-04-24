<?php




class MetadataReaderTest extends SharePointTestCase
{
    public function testLoadMetadata()
    {
        //$edmxContents = MetadataResolver::getMetadata(self::$context);
        $edmxContents = file_get_contents(__DIR__ . '/../generator/metadata/SharePoint16.0.20008.12009.xml');
        $this->assertNotNull($edmxContents);
        return $edmxContents;
    }


    /**
     * @depends testLoadMetadata
     * @param string $edmxContent
     * @throws ReflectionException
     */
    /*public function  testParseMetadata($edmxContent){
        $outputPath = dirname((new ReflectionClass(self::$context))->getFileName());
        $rootNamespace = ((new ReflectionClass(self::$context))->getNamespaceName());
        self::$context->requestFormDigest();
        self::$context->executeQuery();

        $generatorOptions = array(
            'outputPath' => $outputPath,
            'rootNamespace' => $rootNamespace,
            'ignoredTypes' => array(),
            'ignoredProperties' => array()
        );
        $reader = new ODataV3Reader($edmxContent,$generatorOptions);
        $model = $reader->generateModel();
        $this->assertNotNull($model);
        $this->assertNotEquals(0,count($model->getTypes()));
    }*/
}
