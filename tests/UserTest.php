<?php

require_once('SharePointTestCase.php');
require_once('TestUtilities.php');

class UserTest extends SharePointTestCase
{
    public function testLoadCurrentUser()
    {
        $curUser = self::$context->getWeb()->getCurrentUser();
        self::$context->load($curUser);
        self::$context->executeQuery();
        $this->assertNotNull($curUser);
    }


    public function testUpdateCurrentUser()
    {
        $userPrefId = rand(1,10000);
        $emailAddress = "tester$userPrefId@contoso.microsoft.com";
        $curUser = self::$context->getWeb()->getCurrentUser();
        $curUser->setProperty("Email",$emailAddress);
        $curUser->update();
        self::$context->executeQuery();

        self::$context->load($curUser);
        self::$context->executeQuery();
        $this->assertEquals($curUser->getProperty("Email"),$emailAddress);
    }
}
