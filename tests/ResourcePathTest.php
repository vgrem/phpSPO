<?php

use Office365\Runtime\ResourcePath;


class ResourcePathTest extends SharePointTestCase
{
    function testCreatePath(){
        $path = new ResourcePath("RoleAssignments",new ResourcePath("Web"));
        self::assertEquals("RoleAssignments",$path->getSegment());
        self::assertEquals("Web",$path->getParent()->getSegment());
    }

}
