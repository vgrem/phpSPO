<?php

use Office365\PHP\Client\Runtime\OData\MetadataResolver;
use Office365\PHP\Client\Runtime\OData\ODataV3Reader;

class MetadataReaderTest extends SharePointTestCase
{
    public function testLoadMetadata()
    {
        $edmxContents = MetadataResolver::getMetadata(self::$context);
        $this->assertNotNull($edmxContents);
        return $edmxContents;
    }


    /**
     * @depends testLoadMetadata
     * @param string $edmxContent
     */
    public function  testParseMetadata($edmxContent){
        $reader = new ODataV3Reader(self::$context);
        $model = $reader->generateModel($edmxContent);
        $this->assertNotNull($model);
    }
}
