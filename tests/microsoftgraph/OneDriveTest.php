<?php

namespace Office365;

use Office365\Graph\DriveItem;
use Office365\Graph\IdentitySet;


class OneDriveTest extends GraphTestCase
{
    private static $localFile;

    public static function setUpBeforeClass()
    {
        self::$localFile = __DIR__ . "/../../examples/data/SharePoint User Guide.docx";
        parent::setUpBeforeClass();
    }

    public function testMyDrive()
    {
        $myDrive = self::$graphClient->getMe()->getDrive();
        self::$graphClient->load($myDrive);
        self::$graphClient->executeQuery();
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


    public function testCreateFolder()
    {
        $myDrive = self::$graphClient->getMe()->getDrive();
        $folderName = "Archive_" . rand(1, 100000);
        $targetFolder = $myDrive->getRoot()->getChildren()->createFolder($folderName);
        self::$graphClient->executeQuery();
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
        $uploadFileItem = $folderItem->upload($fileName, $fileContent);
        self::$graphClient->executeQuery();
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
        $fileItem->convert($fh,"pdf");
        self::$graphClient->executeQuery();
        fclose($fh);
    }


    /**
     * @depends testUploadFile
     * @param DriveItem $fileItem
     */
    public function testDownloadFile(DriveItem $fileItem)
    {
        $fileName = join(DIRECTORY_SEPARATOR, [sys_get_temp_dir(), basename(self::$localFile)]);
        $fh = fopen($fileName, 'w+');
        $fileItem->download($fh);
        self::$graphClient->executeQuery();
        fclose($fh);
    }


    /**
     * @depends testCreateFolder
     * @param DriveItem $folderItem
     */
    public function testDeleteDriveItem(DriveItem $folderItem)
    {
        $folderItem->delete();
        self::$graphClient->executeQuery();
    }

}