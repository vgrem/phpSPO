<?php

namespace Office365;


class DirectoryTest extends GraphTestCase
{

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
    }

    public function testCurrentUser()
    {
        $currentUser = self::$graphClient->getMe();
        self::$graphClient->load($currentUser);
        self::$graphClient->executeQuery();
        self::assertNotNull($currentUser->getUserPrincipalName());
    }

    public function testListUsers()
    {
        $users = self::$graphClient->getUsers();
        self::$graphClient->load($users);
        self::$graphClient->executeQuery();
        self::assertNotNull($users);
    }

}