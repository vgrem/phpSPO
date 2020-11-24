<?php

namespace Office365;

use Exception;
use Office365\SharePoint\Group;
use Office365\SharePoint\GroupCreationInformation;

class UserTest extends SharePointTestCase
{
    public function testLoadCurrentUser()
    {
        $curUser = self::$context->getWeb()->getCurrentUser()->get()->executeQuery();
        $this->assertNotNull($curUser->getServerObjectIsNull());
    }

    public function testUpdateCurrentUser()
    {
        $userPrefId = "123"; //rand(1,10000);
        $emailAddress = "tester$userPrefId@contoso.microsoft.com";
        $curUser = self::$context->getWeb()->getCurrentUser()
            ->setEmail($emailAddress)
            ->update()
            ->executeQuery();

        self::$context->load($curUser);
        self::$context->executeQuery();
        $this->assertEquals($curUser->getEmail(),$emailAddress);
    }

    
    public function testCreateGroup()
    {
        $groupName = "TestGroup_"  . rand(1,10000);
        $info = new GroupCreationInformation($groupName);
        $group = self::$context->getWeb()->getSiteGroups()->add($info)->executeQuery();
        $this->assertNotNull($group->getLoginName());
        return $group;
    }


    /**
     * @depends testCreateGroup
     * @param Group $group
     * @throws Exception
     */
    public function testFindGroup(Group $group)
    {
        if(!$group->isPropertyAvailable("LoginName")){
            self::$context->load($group);
            self::$context->executeQuery();
        }
        
        
        $result = self::$context->getWeb()->getSiteGroups()->getByName($group->getLoginName());
        self::$context->load($result);
        self::$context->executeQuery();
        $this->assertEquals($group->getLoginName(),$result->getLoginName());
    }


    /**
     * @depends testCreateGroup
     * @param Group $group
     * @throws Exception
     */
    public function testAddUserIntoGroup(Group $group)
    {
        $siteUser = self::$context->getWeb()->ensureUser(self::$testAccountName)->executeQuery();
        $user = $group->getUsers()->addUser($siteUser->getLoginName());
        self::$context->executeQuery();
        $this->assertNotNull($user->getId());
    }

    /**
     * @depends testCreateGroup
     * @param Group $group
     * @throws Exception
     */
    public function testFindUserInGroup(Group $group)
    {
        $groupUsers = $group->getUsers()->get()->executeQuery();
        $result = $groupUsers->findFirst("UserPrincipalName",self::$testAccountName);
        $this->assertNotNull($result);
    }


    /**
     * @depends testCreateGroup
     * @param Group $group
     * @throws Exception
     */
    public function testDeleteGroup(Group $group)
    {
        self::$context->getWeb()->getSiteGroups()
            ->removeByLoginName($group->getLoginName())
            ->executeQuery();

        $key = $group->getLoginName();
        $result = self::$context->getWeb()->getSiteGroups()
            ->filter("LoginName eq '$key'")
            ->get()
            ->executeQuery();
        self::assertEquals(0, $result->getCount());
    }
}
