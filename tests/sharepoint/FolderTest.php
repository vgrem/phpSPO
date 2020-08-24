<?php

namespace Office365;


use Office365\SharePoint\Folder;
use Office365\SharePoint\ListItem;
use Office365\SharePoint\ListTemplateType;
use Office365\SharePoint\RoleType;
use Office365\SharePoint\SPList;


class FolderTest extends SharePointTestCase
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
        self::$targetList->deleteObject()->executeQuery();
        parent::tearDownAfterClass();
    }


    public function testCamlFolderQuery()
    {
        $folderName = "Archive_" . rand(1, 100000);
        $folder = self::$targetList->getRootFolder()->getFolders()->add($folderName)->executeQuery();

        $items = self::$targetList->getItems()->expand("Folder");
        self::$context->load($items);
        self::$context->executeQuery();
        $result = $items->findItems(function (ListItem $item) use ($folder) {
            return $item->getFolder()->getName() === $folder->getName();
        });
        self::assertNotNull($result);
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
        $folderToRename->rename($folderName)->executeQuery();

        $rootFolder = self::$targetList->getRootFolder()->get()->executeQuery();
        $folderUrl = $rootFolder->getServerRelativeUrl() . "/" . $folderName;
        $targetFolder = self::$context->getWeb()->getFolderByServerRelativeUrl($folderUrl)->get()->executeQuery();
        self::assertFalse($targetFolder->getServerObjectIsNull());
        return $targetFolder;
    }


    /**
     * @depends testRenameFolder
     * @param Folder $folder
     */
    public function testAssignFolderPermissions($folder)
    {
        $folderItem = $folder->getListItemAllFields();
        self::$context->load($folderItem,array("HasUniqueRoleAssignments"));
        self::$context->executeQuery();
        self::assertFalse($folderItem->getHasUniqueRoleAssignments());
        //1. create unique perms
        $folderItem->breakRoleInheritance(true);
        self::$context->executeQuery();
        self::$context->load($folderItem,array("HasUniqueRoleAssignments"));
        self::$context->executeQuery();
        self::assertTrue($folderItem->getHasUniqueRoleAssignments());
        //2. grant read permissions for a group
        $visitorGroup = self::$context->getWeb()->getAssociatedVisitorGroup()->get();
        $roleDef = self::$context->getWeb()->getRoleDefinitions()->getByType(RoleType::Reader);
        self::$context->executeQuery();
        $folderItem->getRoleAssignments()->addRoleAssignment($visitorGroup->getId(),$roleDef->getId());
        self::$context->executeQuery();
    }

    /**
     * @depends testRenameFolder
     * @param Folder $sourceFolder
     * @return Folder
     */
    public function testCopyFolder($sourceFolder)
    {
        #ensure source folder contains at least one file
        $sourceFolder
            ->uploadFile("Sample.txt","--some content goes here--")
            ->executeQuery();

        $folderName = "Archive_copy_" . rand(1, 100000);
        $targetFolderUrl = join("/",array($sourceFolder->getServerRelativeUrl(), $folderName)) ;
        $targetFolder = $sourceFolder->copyTo($targetFolderUrl,true)->executeQuery();
        self::assertGreaterThan(0,$targetFolder->getItemCount());
        return $targetFolder;
    }

    /**
     * @depends testRenameFolder
     * @param Folder $sourceFolder
     * @return Folder
     */
    public function testMoveFolder($sourceFolder)
    {
        $targetFolderUrl = join("/",array($sourceFolder->getServerRelativeUrl(), "2006")) ;
        $targetFolder = $sourceFolder->moveTo($targetFolderUrl,1)->executeQuery();
        self::assertGreaterThan(0,$targetFolder->getItemCount());
        return $targetFolder;
    }


    /**
     * @depends testMoveFolder
     * @param Folder $folderToDelete
     */
    public function testDeleteFolder(Folder $folderToDelete)
    {
        $folderName = $folderToDelete->getName();
        $folderToDelete->deleteObject()->executeQuery();

        $filterExpr = "FileLeafRef eq '$folderName'";
        $result = self::$targetList->getItems()->filter($filterExpr)->get()->executeQuery();
        self::assertEmpty($result->getCount());
    }

}
