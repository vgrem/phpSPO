<?php


require_once('SharePointTestCase.php');
require_once('TestUtilities.php');




class ListTest extends SharePointTestCase
{
    public function testIfListCreated()
    {
        $listTitle = "Orders_" . rand(1,100000);
        $list = TestUtilities::ensureList(self::$context,$listTitle, \Office365\PHP\Client\SharePoint\ListTemplateType::Tasks);
        $this->assertEquals($list->getProperty('Title'),$listTitle);
        return $list;
    }


    /**
     * @depends testIfListCreated
     * @param \Office365\PHP\Client\SharePoint\SPList $list
     */
    public function testAssignUniquePermissions(\Office365\PHP\Client\SharePoint\SPList $list){
        $list->breakRoleInheritance(true);
        //$list->update();
        self::$context->executeQuery();

        //self::$context->load($list);
        //self::$context->executeQuery();
        //self::assertTrue($list->hasUniqueRoleAssignments());
    }


    /**
     * @depends testIfListCreated
     * @param \Office365\PHP\Client\SharePoint\SPList $list
     */
    /*public function testVerifyListPermissions(\SharePoint\PHP\Client\SPList $list){
        //1. retrieve current user
        $currentUser = self::$context->getWeb()->getCurrentUser();
        self::$context->load($currentUser);
        self::$context->executeQuery();

        
        //3. verify list permissions
        $loginName = $currentUser->getProperty("LoginName");
        $permissions = $list->getUserEffectivePermissions($loginName);
        self::$context->executeQuery();
        $result = $permissions->has(\SharePoint\PHP\Client\PermissionKind::AddListItems);
        $this->assertTrue($result);
    }*/

    /**
     * @depends testIfListCreated
     * @param \Office365\PHP\Client\SharePoint\SPList $listToDelete
     */
    public function testDeleteList(\Office365\PHP\Client\SharePoint\SPList $listToDelete)
    {
        //$ctx = $listToDelete->getContext();
        $listId = $listToDelete->getProperty('Id');
        $listToDelete->deleteObject();
        self::$context->executeQuery();

        $result =  self::$context->getWeb()->getLists()->filter("Id eq '$listId'");
        self::$context->load($result);
        self::$context->executeQuery();
        $this->assertEquals(0,$result->getCount());
    }



}
