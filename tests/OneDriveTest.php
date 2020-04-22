<?php


class OneDriveTest extends GraphTestCase
{

    public function testMyDrive(){
        $myDrive = self::$graphClient->getMe()->getDrive();
        self::$graphClient->load($myDrive);
        self::$graphClient->executeQuery();
        self::assertNotNull($myDrive->getServerObjectIsNull());
    }

}