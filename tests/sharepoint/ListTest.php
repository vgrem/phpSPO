<?php

namespace Office365;

use Office365\SharePoint\ListTemplateType;
use Office365\SharePoint\SPList;

class ListTest extends SharePointTestCase
{

    public function testIfListCreated()
    {
        $listTitle = "Orders_" . rand(1,100000);
        $list = self::ensureList(self::$context->getWeb(),$listTitle, ListTemplateType::Tasks);
        $this->assertEquals($list->getTitle(),$listTitle);
        return $list;
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
