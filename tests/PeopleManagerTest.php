<?php


use Office365\PHP\Client\SharePoint\UserProfiles\PeopleManager;


class PeopleManagerTest extends SharePointTestCase
{

    private static $accountName = "i:0#.f|membership|marta@mediadev88.onmicrosoft.com";

    public function testGetMyProperties(){
        $peopleManager = new PeopleManager(self::$context);
        $properties = $peopleManager->getMyProperties();
        self::$context->load($properties);
        self::$context->executeQuery();
        $this->assertNotNull($properties->AccountName);
    }


    public function testGetUserProfilePropertyFor(){
        $peopleManager = new PeopleManager(self::$context);
        $result = $peopleManager->getUserProfilePropertyFor(self::$accountName,"AccountName");
        self::$context->executeQuery();
        $this->assertNotNull($result->getValue());
    }


    public function testFollow(){
        $peopleManager = new PeopleManager(self::$context);

        $result = $peopleManager->amIFollowing(self::$accountName);
        self::$context->executeQuery();

        if($result->getValue() == false){
            $peopleManager->follow(self::$accountName);
            self::$context->executeQuery();
        }

        $propertiesList = $peopleManager->getFollowersFor(self::$accountName);
        self::$context->load($propertiesList);
        self::$context->executeQuery();

        self::assertGreaterThanOrEqual(1,$propertiesList->getCount());
    }

    public function testStopFollowing(){
        $peopleManager = new PeopleManager(self::$context);

        $result = $peopleManager->amIFollowing(self::$accountName);
        self::$context->executeQuery();

        if($result->getValue() == true){
            $peopleManager->stopFollowing(self::$accountName);
            self::$context->executeQuery();
        }


        $result2 = $peopleManager->amIFollowing(self::$accountName);
        self::$context->executeQuery();
        self::assertFalse($result2->getValue());
    }


    public function testAmIFollowedBy(){
        $peopleManager = new PeopleManager(self::$context);
        $result = $peopleManager->amIFollowedBy(self::$accountName);
        self::$context->executeQuery();
        self::assertNotNull($result->getValue());
    }



    /*public function testGetMyFollowers(){
        $peopleManager = new \SharePoint\PHP\Client\UserProfiles\PeopleManager(self::$context);
        $properties = $peopleManager->getMyFollowers();
        self::$context->load($properties);
        self::$context->executeQuery();
        $this->assertNotNull($properties->AccountName);
    }*/

}
