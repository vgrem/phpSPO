<?php


require_once('SharePointTestCase.php');
require_once('TestUtilities.php');
require_once(__DIR__.'/../src/userprofiles/PeopleManager.php');


class PeopleManagerTest extends SharePointTestCase
{

    private static $accountName = "i:0#.f|membership|vgrem@media18.onmicrosoft.com";

    public function testGetMyProperties(){
        $peopleManager = new \SharePoint\PHP\Client\UserProfiles\PeopleManager(self::$context);
        $properties = $peopleManager->getMyProperties();
        self::$context->load($properties);
        self::$context->executeQuery();
        $this->assertNotNull($properties->AccountName);
    }


    public function testGetUserProfilePropertyFor(){
        $peopleManager = new \SharePoint\PHP\Client\UserProfiles\PeopleManager(self::$context);
        $result = $peopleManager->getUserProfilePropertyFor(self::$accountName,"AccountName");
        self::$context->executeQuery();
        $this->assertNotNull($result->GetUserProfilePropertyFor);
    }


    public function testFollow(){
        $peopleManager = new \SharePoint\PHP\Client\UserProfiles\PeopleManager(self::$context);

        $result = $peopleManager->amIFollowing(self::$accountName);
        self::$context->executeQuery();

        if($result->AmIFollowing == false){
            $peopleManager->follow(self::$accountName);
            self::$context->executeQuery();
        }

        $propertiesList = $peopleManager->getFollowersFor(self::$accountName);
        self::$context->load($propertiesList);
        self::$context->executeQuery();

        self::assertGreaterThanOrEqual(1,$propertiesList->getCount());
    }

    public function testStopFollowing(){
        $peopleManager = new \SharePoint\PHP\Client\UserProfiles\PeopleManager(self::$context);

        $result = $peopleManager->amIFollowing(self::$accountName);
        self::$context->executeQuery();

        if($result->AmIFollowing == true){
            $peopleManager->stopFollowing(self::$accountName);
            self::$context->executeQuery();
        }


        $result = $peopleManager->amIFollowing(self::$accountName);
        self::$context->executeQuery();
        self::assertFalse($result->AmIFollowing);
    }


    public function testAmIFollowedBy(){
        $peopleManager = new \SharePoint\PHP\Client\UserProfiles\PeopleManager(self::$context);
        $result = $peopleManager->amIFollowedBy(self::$accountName);
        self::$context->executeQuery();
        //$this->assertNotNull($properties->AccountName);
        self::assertNotNull($result->AmIFollowedBy);
    }



    /*public function testGetMyFollowers(){
        $peopleManager = new \SharePoint\PHP\Client\UserProfiles\PeopleManager(self::$context);
        $properties = $peopleManager->getMyFollowers();
        self::$context->load($properties);
        self::$context->executeQuery();
        $this->assertNotNull($properties->AccountName);
    }*/

}
