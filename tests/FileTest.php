<?php

require_once('SharePointTestCase.php');
require_once('TestUtilities.php');


class FileTest extends SharePointTestCase
{
    /**
     * @var \Office365\PHP\Client\SharePoint\SPList
     */
    private static $targetList;



    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $listTitle = "Documents_" . rand(1, 100000);
        self::$targetList = TestUtilities::ensureList(self::$context, $listTitle, \Office365\PHP\Client\SharePoint\ListTemplateType::DocumentLibrary);
    }

    public static function tearDownAfterClass()
    {
        self::$targetList->deleteObject();
        self::$context->executeQuery();
        parent::tearDownAfterClass();
    }


    public function testUploadFiles(){
        $localPath = "../examples/data/";
        $searchPrefix = $localPath . '*.*';
        foreach(glob($searchPrefix) as $filename) {
            $fileCreationInformation = new \Office365\PHP\Client\SharePoint\FileCreationInformation();
            $fileCreationInformation->Content = file_get_contents($filename);
            $fileCreationInformation->Url = basename($filename);
            $fileCreationInformation->Overwrite = true;

            $uploadFile = self::$targetList->getRootFolder()->getFiles()->add($fileCreationInformation);
            self::$context->executeQuery();
            $this->assertEquals($uploadFile->getProperty("Name"),$fileCreationInformation->Url);
        }
    }


    public function testGetFileVersions()
    {
        $files = self::$targetList->getRootFolder()->getFiles()->select("Name,Version");
        self::$context->load($files);
        self::$context->executeQuery();
        //$this->assertTrue($files->AreItemsAvailable());
        
    }

    public function testCreateFolder()
    {
        $folderName = "Archive_" . rand(1, 100000);
        $folder = self::$targetList->getRootFolder()->getFolders()->add($folderName);
        self::$context->load(self::$targetList->getRootFolder());
        self::$context->executeQuery();
        $expectedFolderUrl = self::$targetList->getRootFolder()->getProperty("ServerRelativeUrl") . "/" . $folderName;
        $this->assertEquals($folder->getProperty("ServerRelativeUrl"), $expectedFolderUrl);
        return $folder;
    }


    /**
     * @depends testCreateFolder
     * @param \Office365\PHP\Client\SharePoint\Folder $folderToRename
     */
    public function testRenameFolder(\Office365\PHP\Client\SharePoint\Folder $folderToRename)
    {
        $folderName = "2015";
        $folderToRename->rename($folderName);
        self::$context->executeQuery();

        self::$context->load(self::$targetList->getRootFolder());
        self::$context->executeQuery();
        $folderUrl = self::$targetList->getRootFolder()->getProperty("ServerRelativeUrl") . "/" . $folderName;
        $folder = self::$context->getWeb()->getFolderByServerRelativeUrl($folderUrl);
        self::$context->load($folder);
        self::$context->executeQuery();
        self::assertNotEmpty($folder->getProperties());
    }


    /**
     * @depends testCreateFolder
     * @param \Office365\PHP\Client\SharePoint\Folder $folderToDelete
     */
    public function testDeleteFolder(\Office365\PHP\Client\SharePoint\Folder $folderToDelete)
    {
        $folderToDelete->deleteObject();
        self::$context->executeQuery();
    }

}
