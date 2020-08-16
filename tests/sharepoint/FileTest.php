<?php

namespace Office365;

use DateTime;
use Office365\Runtime\Auth\UserCredentials;
use Office365\SharePoint\File;
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


    public function testGetFileFromAbsUrl(){
        $settings = include(__DIR__ . '/../../Settings.php');
        $pageAbsUrl = $settings["Url"] . "/sites/team/SitePages/Home.aspx";
        $credentials = new UserCredentials($settings['UserName'],$settings['Password']);
        $file = File::fromUrl($pageAbsUrl)->withCredentials($credentials)->get()->executeQuery();
        self::assertNotEmpty($file->getName());
    }


    public function testUploadFiles(){
        $localPath = __DIR__ . "/../../examples/data/";
        $searchPrefix = $localPath . '*.*';
        $results = [];
        foreach(glob($searchPrefix) as $filename) {
            $uploadFile = self::$targetList->getRootFolder()->uploadFile(basename($filename),file_get_contents($filename));
            self::$context->executeQuery();
            $this->assertNotNull($uploadFile->getLinkingUrl());
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


    /**
     * @depends testUploadFiles
     * @param File $file
     */
    public function testGetFileVersions($file)
    {
        self::$context->load($file,array("Versions"));
        self::$context->executeQuery();
        self::assertNotNull($file->getVersions());
    }

    public function testUploadLargeFile()
    {
        $localPath = __DIR__ . "/../../examples/data/big_buck_bunny.mp4";
        $targetFileName = "large_" . basename($localPath);
        $session = self::$targetList->getRootFolder()->getFiles()->createUploadSession($localPath, $targetFileName,
            function ($uploadedBytes) {
                self::assertNotNull($uploadedBytes);
            });
        self::$context->executeQuery();
        $uploadFile = $session->getFile();
        self::assertNotNull($uploadFile->getName());
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

}
