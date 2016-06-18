<?php

require_once('SharePointTestCase.php');
require_once('TestUtilities.php');


class FileTest extends SharePointTestCase
{
    /**
     * @var \SharePoint\PHP\Client\SPList
     */
    private static $targetList;



    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $listTitle = "Documents_" . rand(1, 100000);
        self::$targetList = TestUtilities::ensureList(self::$context, $listTitle, \SharePoint\PHP\Client\ListTemplateType::DocumentLibrary);
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
            $fileCreationInformation = array(
                'Content' => file_get_contents($filename),
                'Url' => basename($filename)
            );

            $uploadFile = self::$targetList->getRootFolder()->getFiles()->add($fileCreationInformation);
            self::$context->executeQuery();
            $this->assertEquals($uploadFile->getProperty("Name"),$fileCreationInformation["Url"]);
        }
    }


    public function testGetFileVersions()
    {
        $files = self::$targetList->getRootFolder()->getFiles()->select("Name,Version");
        self::$context->load($files);
        self::$context->executeQuery();
        $this->assertTrue($files->AreItemsAvailable());
        
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
     * @param \SharePoint\PHP\Client\Folder $folderToRename
     */
    public function testRenameFolder(\SharePoint\PHP\Client\Folder $folderToRename)
    {
        $folderName = "2015";
        $ctx = $folderToRename->getContext();
        $folderToRename->rename($folderName);
        $ctx->executeQuery();


        $ctx->load(self::$targetList->getRootFolder());
        $ctx->executeQuery();
        $folderUrl = self::$targetList->getRootFolder()->getProperty("ServerRelativeUrl") . "/" . $folderName;
        $folder = $ctx->getWeb()->getFolderByServerRelativeUrl($folderUrl);
        $ctx->load($folder);
        $ctx->executeQuery();
        $this->assertNotNull($folder);
    }


    /**
     * @depends testCreateFolder
     * @param \SharePoint\PHP\Client\Folder $folderToDelete
     */
    public function testDeleteFolder(\SharePoint\PHP\Client\Folder $folderToDelete)
    {
        $folderToDelete->deleteObject();
        self::$context->executeQuery();
    }

}
