<?php

namespace Office365\PHP\Client\Runtime;

use Office365\PHP\Client\Runtime\OData\ODataPathBuilder;
use SharePointTestCase;


class ResourcePathTest extends SharePointTestCase
{

    function testCreatePath(){
        $url ="web/RoleAssignments";
        $path = ODataPathBuilder::fromUrl(self::$context,$url);
        self::assertNotNull($path->ServerObjectIsNull);
        self::assertEquals("RoleAssignments",$path->toString());
        self::assertNotNull($path->getParent()->ServerObjectIsNull);
        self::assertEquals("web",$path->getParent()->toString());
    }

}
