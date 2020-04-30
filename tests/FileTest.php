<?php


use Office365\Runtime\Types\Guid;
use Office365\SharePoint\File;
use Office365\SharePoint\FileCreationInformation;
use Office365\SharePoint\Folder;
use Office365\SharePoint\ListItem;
use Office365\SharePoint\ListTemplateType;
use Office365\SharePoint\SPList;
use Office365\SharePoint\Web;

class FileTest extends SharePointTestCase
{
    /**
     * @var SPList
     */
    private static $targetList;



    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $listTitle = "Documents_" . rand(1, 100000);
        self::$targetList = self::ensureList(self::$context->getWeb(), $listTitle, ListTemplateType::DocumentLibrary);
    }

    public static function tearDownAfterClass()
    {
        self::$targetList->deleteObject();
        self::$context->executeQuery();
        parent::tearDownAfterClass();
    }


    public function testCamlFolderQuery()
    {
        $folderName = "Archive_" . rand(1, 100000);
        $folder = self::$targetList->getRootFolder()->getFolders()->add($folderName);
        self::$context->executeQuery();

        $items = self::$targetList->getItems()->expand("Folder");
        self::$context->load($items);
        self::$context->executeQuery();
        $result = $items->findItems(function (ListItem $item) use ($folder) {
                return $item->getFolder()->getProperty("Name") === $folder->getProperty('Name');

        });
        self::assertNotNull($result);
    }


    public function testUploadFiles(){
        $localPath = __DIR__ . "/../examples/data/";
        $searchPrefix = $localPath . '*.*';
        $results = [];
        foreach(glob($searchPrefix) as $filename) {
            $fileCreationInformation = new FileCreationInformation();
            $fileCreationInformation->Content = file_get_contents($filename);
            $fileCreationInformation->Url = basename($filename);
            $fileCreationInformation->Overwrite = true;

            $uploadFile = self::$targetList->getRootFolder()->getFiles()->add($fileCreationInformation);
            self::$context->executeQuery();
            $this->assertEquals($uploadFile->getProperty("Name"),$fileCreationInformation->Url);
            $results[] = $uploadFile;
        }
        $this->assertTrue(true);
        return $results[0];
    }

    /**
     * @depends testUploadFiles
     * @param File $file
     */
    public function testAssignFilePermissions($file)
    {
        $fileItem = $file->getListItemAllFields();
        $fileItem->breakRoleInheritance(true);
        self::$context->executeQuery();
        self::$context->load($fileItem,array("HasUniqueRoleAssignments"));
        self::$context->executeQuery();
        self::assertTrue($fileItem->getHasUniqueRoleAssignments());
    }



    public function testUploadLargeFile()
    {
        $uploadSessionId = Guid::newGuid();
        $localPath = __DIR__ . "/../examples/data/big_buck_bunny.mp4";
        $chunkSize = 1024 * 1024;
        $fileSize = filesize($localPath);
        $firstChunk = true;
        $handle = fopen($localPath, 'rb');
        $offset = 0;
        $fileCreationInformation = new FileCreationInformation();
        $fileCreationInformation->Url = "large_" . basename($localPath);
        $uploadFile = self::$targetList->getRootFolder()->getFiles()->add($fileCreationInformation);
        self::$context->executeQuery();

        while (!feof($handle)) {
            $buffer = fread($handle, $chunkSize);
            $bytesRead = ftell ( $handle );
            if ($firstChunk) {
                $resultOffset = $uploadFile->startUpload($uploadSessionId, $buffer);
                self::$context->executeQuery();
                self::assertNotNull($resultOffset->getValue());
                $firstChunk = false;
            } elseif ($fileSize == $bytesRead) {
                $uploadFile = $uploadFile->finishUpload($uploadSessionId,$offset, $buffer);
                self::$context->executeQuery();
            } else {
                $resultOffset = $uploadFile->continueUpload($uploadSessionId,$offset, $buffer);
                self::$context->executeQuery();
                self::assertNotNull($resultOffset->getValue());
            }
            $offset = $bytesRead;
        }
        fclose($handle);
        self::assertNotNull($uploadFile->getProperty("Name"));

    }

    /**
     * @depends testUploadFiles
     * @param $uploadFile
     */
    public function testUploadedFileCreateAnonymousLink(File $uploadFile)
    {
        $listItem = $uploadFile->getListItemAllFields();
        self::$context->load($listItem,array("EncodedAbsUrl"));
        self::$context->executeQuery();

        $fileUrl = $listItem->getProperty("EncodedAbsUrl");
        $result = Web::createAnonymousLink(self::$context,$fileUrl,false);
        self::$context->executeQuery();
        self::assertNotEmpty($result->getValue());

        $expireDate = new DateTime('now +1 day');
        $result = Web::createAnonymousLinkWithExpiration(self::$context,$fileUrl,false,$expireDate->format(DateTime::ATOM));
        self::$context->executeQuery();
        self::assertNotEmpty($result->getValue());
    }


    /**
     * @depends testUploadFiles
     * @param $fileToDelete
     */
    public function testDeleteFile(File $fileToDelete)
    {
        $fileName = $fileToDelete->getProperty("Name");
        $fileToDelete->deleteObject();
        self::$context->executeQuery();


        $filesResult = self::$targetList->getRootFolder()->getFiles()->filter("Name eq '$fileName'");
        self::$context->load($filesResult);
        self::$context->executeQuery();
        $this->assertEquals(0,$filesResult->getCount());
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
     * @param Folder $folderToRename
     * @return Folder
     */
    public function testRenameFolder(Folder $folderToRename)
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
        self::assertFalse($folder->getServerObjectIsNull());
        return $folder;
    }


    /**
     * @depends testRenameFolder
     * @param Folder $folderToDelete
     */
    public function testDeleteFolder(Folder $folderToDelete)
    {
        $folderName = $folderToDelete->getProperty("Name");
        $folderToDelete->deleteObject();
        self::$context->executeQuery();


        $filterExpr = "FileLeafRef eq '$folderName'";
        $result = self::$targetList->getItems()->filter($filterExpr);
        self::$context->load($result);
        self::$context->executeQuery();
        self::assertEmpty($result->getCount());
    }

}
