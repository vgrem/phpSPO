<?php

namespace Office365;

use Office365\SharePoint\UserProfiles\PeopleManager;


class PeopleManagerTest extends SharePointTestCase
{

    /**
     * @var SharePoint\User
     */
    private static $testUser;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::$testUser = self::$context->getWeb()->ensureUser(self::$testAccountName)->executeQuery();
    }

    public function testGetMyProperties()
    {
        $peopleManager = new PeopleManager(self::$context);
        $properties = $peopleManager->getMyProperties()->get()->executeQuery();
        $this->assertNotNull($properties->getAccountName());
    }


    public function testGetUserProfilePropertyFor()
    {
        $peopleManager = new PeopleManager(self::$context);
        $result = $peopleManager->getUserProfilePropertyFor(self::$testUser->getLoginName(), "AccountName");
        self::$context->executeQuery();
        $this->assertNotNull($result->getValue());
    }


    public function testFollow()
    {
        $peopleManager = new PeopleManager(self::$context);
        $result = $peopleManager->amIFollowing(self::$testUser->getLoginName())->executeQuery();
        if ($result->getValue() == false) {
            $peopleManager->follow(self::$testUser->getLoginName())->executeQuery();
        }

        $propertiesList = $peopleManager->getFollowersFor(self::$testUser->getLoginName())->get()->executeQuery();
        self::assertGreaterThanOrEqual(1, $propertiesList->getCount());
    }

    public function testStopFollowing()
    {
        $peopleManager = new PeopleManager(self::$context);
        $result = $peopleManager->amIFollowing(self::$testUser->getLoginName())->executeQuery();
        if ($result->getValue() == true) {
            $peopleManager->stopFollowing(self::$testUser->getLoginName())->executeQuery();
        }

        $result2 = $peopleManager->amIFollowing(self::$testUser->getLoginName())->executeQuery();
        self::assertFalse($result2->getValue());
    }


    public function testAmIFollowedBy()
    {
        $peopleManager = new PeopleManager(self::$context);
        $result = $peopleManager->amIFollowedBy(self::$testUser->getLoginName())->executeQuery();
        self::assertNotNull($result->getValue());
    }


    /*public function testGetMyFollowers(){
        $peopleManager = new \sharepoint\UserProfiles\PeopleManager(self::$context);
        $properties = $peopleManager->getMyFollowers();
        self::$context->load($properties);
        self::$context->executeQuery();
        $this->assertNotNull($properties->AccountName);
    }*/

}
