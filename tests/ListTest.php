<?php


require_once('SharePointTestCase.php');
require_once('TestUtilities.php');




class ListTest extends SharePointTestCase
{
    public function testIfListCreated()
    {
        $listTitle = "Orders_" . rand(1,100000);
        $list = TestUtilities::ensureList(self::$context,$listTitle,\SharePoint\PHP\Client\ListTemplateType::Tasks);
        $this->assertEquals($list->getProperty('Title'),$listTitle);
        return $list;
    }


    /**
     * @depends testIfListCreated
     * @param \SharePoint\PHP\Client\SPList $list
     */
    public function testAssignUniquePermissions(\SharePoint\PHP\Client\SPList $list){
        $list->breakRoleInheritance(true);
        //$list->update();
        self::$context->executeQuery();

    }


    /**
     * @depends testIfListCreated
     * @param \SharePoint\PHP\Client\SPList $list
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
     * @param \SharePoint\PHP\Client\SPList $listToDelete
     */
    public function testDeleteList(\SharePoint\PHP\Client\SPList $listToDelete)
    {
        $ctx = $listToDelete->getContext();
        $listId = $listToDelete->getProperty('Id');
        $listToDelete->deleteObject();
        $ctx->executeQuery();

        $result =  $ctx->getWeb()->getLists()->filter("Id eq '$listId'");
        $ctx->load($result);
        $ctx->executeQuery();
        $this->assertEquals(0,$result->getCount());
    }



}
