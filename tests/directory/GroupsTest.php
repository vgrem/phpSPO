<?php

namespace Office365;


use Office365\Directory\Groups\Group;
use Office365\Runtime\Http\RequestException;

class GroupsTest extends GraphTestCase
{

    /**
     * @var Group
     */
    private static $targetGroup;

    public function testCreateM365Group()
    {
        $grpName = "TestGroup_" . rand(1, 100000);
        self::$targetGroup = self::$graphClient->getGroups()->createM365($grpName)->executeQuery();
        self::assertNotNull(self::$targetGroup->getResourcePath());
    }

    public function testListGroups()
    {
        $result = self::$graphClient->getGroups()->get()->top(10)->executeQuery();
        self::assertNotNull($result->getResourcePath());
        self::assertNotEmpty($result->getData());
    }


    public function testListOwners()
    {
        $result = self::$targetGroup->getOwners()->get()->top(10)->executeQuery();
        self::assertNotNull($result->getResourcePath());
        self::assertNotEmpty($result->getData());
    }

    public function testAddMember()
    {
        $user = self::$graphClient->getUsers()->getByUserPrincipalName(self::$testAccountName);
        $result = self::$targetGroup->addMemberUser($user)->executeQuery();
        self::assertNotNull($result->getResourcePath());
    }

    public function testListMembers()
    {
        $result = self::$targetGroup->getMembers()->get()->top(10)->executeQuery();
        self::assertNotNull($result->getResourcePath());
        self::assertNotEmpty($result->getData());
    }


    public function testDeleteGroup()
    {
        self::$targetGroup->deleteObject()->executeQuery();

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(404);
        self::$targetGroup->get()->executeQuery();
    }


}