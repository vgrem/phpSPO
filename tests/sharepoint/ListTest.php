<?php

namespace Office365;

use Office365\SharePoint\ListTemplateType;
use Office365\SharePoint\SPList;

class ListTest extends SharePointTestCase
{
    private static $listTitle;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        self::$listTitle = "Orders_" . rand(1,100000);
    }


    public function testIfListCreated()
    {
        $list = self::ensureList(self::$context->getWeb(),self::$listTitle, ListTemplateType::Tasks);
        $this->assertEquals($list->getTitle(),self::$listTitle);
        return $list;
    }

    /**
     * @depends testIfListCreated
     * @param SPList $targetList
     */
    public function testGetListByUrl(SPList $targetList)
    {
        $listFolder = $targetList->getRootFolder();
        self::$context->load($listFolder);
        self::$context->executeQuery();

        $list =  self::$context->getWeb()->getList($listFolder->getServerRelativeUrl());
        self::$context->load($list);
        self::$context->executeQuery();
        $this->assertNotNull($list->getId());
    }


    /**
     * @depends testIfListCreated
     * @param SPList $list
     */
    /*public function testAssignUniquePermissions(\Office365\sharepoint\SPList $list){
        $list->breakRoleInheritance(true);
        //$list->update();
        self::$context->executeQuery();

        //self::$context->load($list);
        //self::$context->executeQuery();
        //self::assertTrue($list->hasUniqueRoleAssignments());
    }*/


    /**
     * @depends testIfListCreated
     * @param SPList $list
     */
    /*public function testVerifyListPermissions(\sharepoint\SPList $list){
        //1. retrieve current user
        $currentUser = self::$context->getWeb()->getCurrentUser();
        self::$context->load($currentUser);
        self::$context->executeQuery();

        
        //3. verify list permissions
        $loginName = $currentUser->getProperty("LoginName");
        $permissions = $list->getUserEffectivePermissions($loginName);
        self::$context->executeQuery();
        $result = $permissions->has(\sharepoint\PermissionKind::AddListItems);
        $this->assertTrue($result);
    }*/

    /**
     * @depends testIfListCreated
     * @param SPList $listToDelete
     */
    public function testDeleteList(SPList $listToDelete)
    {
        //$ctx = $listToDelete->getContext();
        $listId = $listToDelete->getId();
        $listToDelete->deleteObject();
        self::$context->executeQuery();

        $result =  self::$context->getWeb()->getLists()->filter("Id eq '$listId'");
        self::$context->load($result);
        self::$context->executeQuery();
        $this->assertEquals(0,$result->getCount());
    }

}
