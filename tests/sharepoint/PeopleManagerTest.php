<?php

namespace Office365;


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
        $properties = self::$context->getPeopleManager()->getMyProperties()->get()->executeQuery();
        $this->assertNotNull($properties->getAccountName());
    }


    public function testGetUserProfilePropertyFor()
    {
        $result = self::$context->getPeopleManager()->getUserProfilePropertyFor(self::$testUser->getLoginName(), "AccountName");
        self::$context->executeQuery();
        $this->assertNotNull($result->getValue());
    }


    public function testFollow()
    {
        $result = self::$context->getPeopleManager()->amIFollowing(self::$testUser->getLoginName())->executeQuery();
        if (!$result->getValue()) {
            self::$context->getPeopleManager()->follow(self::$testUser->getLoginName())->executeQuery();
        }

        $propertiesList = self::$context->getPeopleManager()->getFollowersFor(self::$testUser->getLoginName())->get()->executeQuery();
        self::assertGreaterThanOrEqual(1, $propertiesList->getCount());
    }

    public function testStopFollowing()
    {
        $result = self::$context->getPeopleManager()->amIFollowing(self::$testUser->getLoginName())->executeQuery();
        if ($result->getValue()) {
            self::$context->getPeopleManager()->stopFollowing(self::$testUser->getLoginName())->executeQuery();
        }

        $result2 = self::$context->getPeopleManager()->amIFollowing(self::$testUser->getLoginName())->executeQuery();
        self::assertFalse($result2->getValue());
    }


    public function testAmIFollowedBy()
    {
        $result = self::$context->getPeopleManager()->amIFollowedBy(self::$testUser->getLoginName())->executeQuery();
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
