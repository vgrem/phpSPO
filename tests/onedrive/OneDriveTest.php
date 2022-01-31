<?php

namespace Office365;

use Office365\Directory\Identities\IdentitySet;
use Office365\OneDrive\DriveItems\DriveItem;


class OneDriveTest extends GraphTestCase
{
    private static $localFile;

    public static function setUpBeforeClass(): void
    {
        self::$localFile = __DIR__ . "/../../examples/data/SharePoint User Guide.docx";
        parent::setUpBeforeClass();
    }

    public function testMyDrive()
    {
        $myDrive = self::$graphClient->getMe()->getDrive()->get()->executeQuery();
        self::assertNotNull($myDrive->getWebUrl());
    }


    public function testMyDriveProperties()
    {
        $myDrive = self::$graphClient->getMe()->getDrive();
        self::$graphClient->load($myDrive, ["Owner"]);
        self::$graphClient->executeQuery();
        $owner = $myDrive->getOwner();
        self::assertTrue($owner instanceof IdentitySet);
    }


    public function testMyDrivePropertiesFluentApi()
    {
        $myDrive = self::$graphClient->getMe()->getDrive()->select("Owner")->get()->executeQuery();
        $owner = $myDrive->getOwner();
        self::assertTrue($owner instanceof IdentitySet);
    }


    public function testCreateFolder()
    {
        $myDrive = self::$graphClient->getMe()->getDrive();
        $folderName = "Archive_" . rand(1, 100000);
        $targetFolder = $myDrive->getRoot()->getChildren()->createFolder($folderName)->executeQuery();
        self::assertNotNull($targetFolder->getName());
        return $targetFolder;
    }


    /**
     * @depends testCreateFolder
     * @param DriveItem $folderItem
     * @return DriveItem
     */
    public function testUploadFile(DriveItem $folderItem)
    {
        $fileContent = file_get_contents(self::$localFile);
        $fileName = basename(self::$localFile);
        $uploadFileItem = $folderItem->upload($fileName, $fileContent)->executeQuery();
        self::assertNotNull($uploadFileItem->getWebUrl());
        return $uploadFileItem;
    }


    /**
     * @depends testUploadFile
     * @param DriveItem $fileItem
     */
    public function testConvertFile(DriveItem $fileItem)
    {
        $fileName = join(DIRECTORY_SEPARATOR, [sys_get_temp_dir(),"SampleFile.pdf" ]);
        $fh = fopen($fileName, 'w+');
        $fileItem->convert($fh,"pdf")->executeQuery();
        fclose($fh);
        self::assertGreaterThan(0, filesize($fileName));
    }


    /**
     * @depends testUploadFile
     * @param DriveItem $fileItem
     */
    public function testDownloadFile(DriveItem $fileItem)
    {
        $fileName = join(DIRECTORY_SEPARATOR, [sys_get_temp_dir(), basename(self::$localFile)]);
        $fh = fopen($fileName, 'w+');
        $fileItem->download($fh)->executeQuery();
        fclose($fh);
        self::assertGreaterThan(0, filesize($fileName));
    }


    /**
     * @depends testCreateFolder
     * @param DriveItem $folderItem
     */
    public function testDeleteDriveItem(DriveItem $folderItem)
    {
        $resultBefore = self::$graphClient->getMe()->getDrive()->getRoot()->getChildren()->get()->executeQuery();
        $folderItem->delete()->executeQuery();
        $resultAfter = self::$graphClient->getMe()->getDrive()->getRoot()->getChildren()->get()->executeQuery();
        self::assertEquals($resultBefore->getCount() - 1, $resultAfter->getCount());
    }

}