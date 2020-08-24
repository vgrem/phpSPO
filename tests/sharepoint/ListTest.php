<?php

namespace Office365;

use Office365\SharePoint\ListTemplateType;
use Office365\SharePoint\PermissionKind;
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
        $listFolder = $targetList->getRootFolder()->get()->executeQuery();
        $list =  self::$context->getWeb()->getList($listFolder->getServerRelativeUrl())->executeQuery();
        $this->assertNotNull($list->getId());
    }


    /**
     * @depends testIfListCreated
     * @param SPList $list
     */
    public function testAssignUniquePermissions(\Office365\sharepoint\SPList $list){
        $list->breakRoleInheritance(true)->executeQuery();
        $list->select("HasUniqueRoleAssignments")->get()->executeQuery();
        self::assertTrue($list->getHasUniqueRoleAssignments());
    }


    /**
     * @depends testIfListCreated
     * @param SPList $list
     */
    public function testVerifyListPermissions(SPList $list){
        //1. retrieve current user
        $currentUser = self::$context->getWeb()->getCurrentUser()->get()->executeQuery();

        //2. verify list permissions
        $loginName = $currentUser->getProperty("LoginName");
        $permissions = $list->getUserEffectivePermissions($loginName);
        self::$context->executeQuery();
        $result = $permissions->has(PermissionKind::AddListItems);
        $this->assertTrue($result);
    }

    /**
     * @depends testIfListCreated
     * @param SPList $listToDelete
     */
    public function testDeleteList(SPList $listToDelete)
    {
        $listIdToDel = $listToDelete->getId();
        $listToDelete->deleteObject()->executeQuery();

        $result =  self::$context->getWeb()->getLists()->filter("Id eq '$listIdToDel'")->get()->executeQuery();
        $this->assertEquals(0,$result->getCount());
    }
}
