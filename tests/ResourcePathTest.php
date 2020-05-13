<?php

namespace Office365;

use Office365\Runtime\ResourcePath;
use PHPUnit\Framework\TestCase;


class ResourcePathTest extends TestCase
{
    function testCreatePath(){
        $path = new ResourcePath("RoleAssignments",new ResourcePath("Web"));
        self::assertEquals("RoleAssignments",$path->getSegment());
        self::assertEquals("Web",$path->getParent()->getSegment());
    }

}
