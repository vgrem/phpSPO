<?php



use Office365\PHP\Client\Runtime\OData\ODataPathBuilder;


class ResourcePathTest extends SharePointTestCase
{

    function testCreatePath(){
        $url ="web/RoleAssignments";
        $path = ODataPathBuilder::fromUrl($url);
        self::assertEquals("RoleAssignments",$path->getSegment());
        self::assertEquals("web",$path->getParent()->getSegment());
    }

}
