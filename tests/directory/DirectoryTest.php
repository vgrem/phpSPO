<?php

namespace Office365;


class DirectoryTest extends GraphTestCase
{

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
    }

    public function testCurrentUser()
    {
        $currentUser = self::$graphClient->getMe()->get()->executeQuery();
        self::assertNotNull($currentUser->getUserPrincipalName());
    }

    public function testListUsers()
    {
        $users = self::$graphClient->getUsers()->get()->executeQuery();
        self::assertNotNull($users->getResourcePath());
    }

    public function testGetUser()
    {
        $user = self::$graphClient->getUsers()[self::$testAccountName]->get()->executeQuery();
        self::assertNotNull($user->getResourcePath());
    }

}