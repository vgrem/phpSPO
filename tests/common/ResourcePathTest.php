<?php

namespace Office365;

use Office365\Runtime\Paths\EntityPath;
use Office365\Runtime\Paths\ServiceOperationPath;
use Office365\Runtime\Paths\ResourcePathUrl;
use Office365\Runtime\ResourcePath;
use PHPUnit\Framework\TestCase;


class ResourcePathTest extends TestCase
{
    function testCreateEntitySetPath(){
        $path = new ResourcePath("RoleAssignments",new ResourcePath("Web"));
        self::assertEquals("RoleAssignments",$path->getName());
        self::assertEquals("Web",$path->getParent()->getName());
        self::assertEquals("/Web/RoleAssignments",$path->toUrl());
    }

    function testCreateSingleEntityPath(){
        $path = new EntityPath(1, new ResourcePath("SiteUsers",new ResourcePath("Web")));
        self::assertEquals("/Web/SiteUsers(1)",$path->toUrl());
    }

    function testCreateFilePath(){
        $filePath = "archive/2020/sample.docx";
        $path = new ResourcePathUrl($filePath, new ResourcePath("root",new ResourcePath("drive")));
        $encFilePath = rawurlencode($filePath);
        self::assertEquals("/drive/root:/$encFilePath:/",$path->toUrl());
    }

    function testCreateStaticFunctionPath(){
        $filePath = "archive/2020/sample.docx";
        $path = new ServiceOperationPath("getFileByServerRelativeUrl", array($filePath),
            new ResourcePath("Web"));
        self::assertEquals("/Web/getFileByServerRelativeUrl('$filePath')",$path->toUrl());
    }

}
