<?php

namespace Office365;

use Office365\Graph\IdentitySet;

class OneDriveTest extends GraphTestCase
{

    public function testMyDrive(){
        $myDrive = self::$graphClient->getMe()->getDrive();
        self::$graphClient->load($myDrive);
        self::$graphClient->executeQuery();
        self::assertNotNull($myDrive->getWebUrl());
    }


    public function testMyDriveProperties(){
        $myDrive = self::$graphClient->getMe()->getDrive();
        self::$graphClient->load($myDrive,["Owner"]);
        self::$graphClient->executeQuery();
        $owner = $myDrive->getOwner();
        self::assertTrue($owner instanceof IdentitySet);
    }


    public function testCreateFolder(){
        $myDrive = self::$graphClient->getMe()->getDrive();
        $folderName = "Archive_" . rand(1, 100000);
        $targetFolder = $myDrive->getRoot()->getChildren()->createFolder($folderName);
        self::$graphClient->executeQuery();
        self::assertNotNull($targetFolder->getName());
    }

}