<?php

use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\SharePoint\ClientContext;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\SharePoint\SPList;
require_once '../bootstrap.php';
global $Settings;

try {
    $authCtx = new AuthenticationContext($Settings['Url']);
    $authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
    $ctx = new ClientContext($Settings['Url'],$authCtx);

    $localPath = "../data/";
    $targetLibraryTitle = "Documents";
    $targetFolderUrl = "/sites/contoso/Documents/Archive";

    $list = TestUtilities::ensureList($ctx,$targetLibraryTitle, \Office365\PHP\Client\SharePoint\ListTemplateType::DocumentLibrary);
    //enumFolders($list);
    //uploadFiles($localPath,$list);
    //$localFilePath = $localPath . "/SharePoint User Guide.docx";
    //uploadFileIntoFolder($ctx,$localFilePath,$targetFolderUrl);
    processFiles($list,$localPath);
    //deleteFolder($ctx,$folderUrl);
    //saveFile($ctx,$localFilePath,$fileUrl);

}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}


function enumFolders(SPList $list)
{
    $ctx = $list->getContext();
    $folders = $list->getRootFolder()->getFolders();
    if($folders->getServerObjectIsNull() == true){  //determine whether folders has been loaded or not
        $ctx->load($folders);
        $ctx->executeQuery();
    }

    foreach ($folders->getData() as $folder) {
        print "File name: '{$folder->Name}'\r\n";
    }

}


function processFiles(SPList $list,$targetPath)
{
    $ctx = $list->getContext();
    $files = $list->getRootFolder()->getFiles();
    $ctx->load($files);
    $ctx->executeQuery();

    foreach ($files->getData() as $file) {
        print "File name: '{$file->Name}'\r\n";

        //checkoutFile($ctx,$file->ServerRelativeUrl);
        //checkinFile($ctx,$file->ServerRelativeUrl);
        //approveFile($ctx,$file->ServerRelativeUrl);
        $fileName = $targetPath . "/" . basename($file->ServerRelativeUrl);
        downloadFile($ctx,$file->ServerRelativeUrl,$fileName);
    }
}




function deleteFolder(ClientContext $ctx, $folderUrl){
    $folder = $ctx->getWeb()->getFolderByServerRelativeUrl($folderUrl);
    $folder->deleteObject();
    $ctx->executeQuery();
    print "Folder has been deleted\r\n";
}


function checkoutFile(ClientContext $ctx, $fileUrl){
    $file = $ctx->getWeb()->getFileByServerRelativeUrl($fileUrl);
    $file->checkOut();
    $ctx->executeQuery();
    print "File has been checked out\r\n";
}


function checkinFile(ClientContext $ctx, $fileUrl){
    $file = $ctx->getWeb()->getFileByServerRelativeUrl($fileUrl);
    $file->checkIn('');
    $ctx->executeQuery();
    print "File has been checked in\r\n";
}

function approveFile(ClientContext $ctx, $fileUrl){
    $file = $ctx->getWeb()->getFileByServerRelativeUrl($fileUrl);
    $file->approve('');
    $ctx->executeQuery();
    print "File {$fileUrl} has been approved\r\n";
}

function uploadFiles($localPath, \Office365\PHP\Client\SharePoint\SPList $targetList){

    $ctx = $targetList->getContext();

    $searchPrefix = $localPath . '*.*';
    foreach(glob($searchPrefix) as $filename) {
        $fileCreationInformation = new \Office365\PHP\Client\SharePoint\FileCreationInformation();
        $fileCreationInformation->Content = file_get_contents($filename);
        $fileCreationInformation->Url = basename($filename);

        $uploadFile = $targetList->getRootFolder()->getFiles()->add($fileCreationInformation);
        $ctx->executeQuery();
        print "File {$uploadFile->getProperty('Name')} has been uploaded\r\n";

        $uploadFile->getListItemAllFields()->setProperty('Title',basename($filename));
        $uploadFile->getListItemAllFields()->update();
        $ctx->executeQuery();
    }


}


function uploadFileIntoFolder(ClientContext $ctx, $localPath, $targetFolderUrl)
{
    $fileName = basename($localPath);
    $fileCreationInformation = new \Office365\PHP\Client\SharePoint\FileCreationInformation();
    $fileCreationInformation->Content = file_get_contents($localPath);
    $fileCreationInformation->Url = $fileName;


    $uploadFile = $ctx->getWeb()->getFolderByServerRelativeUrl($targetFolderUrl)->getFiles()->add($fileCreationInformation);
    $ctx->executeQuery();
    print "File {$uploadFile->getProperty('Name')} has been uploaded\r\n";

    //$uploadFile->getListItemAllFields()->setProperty('Title', $fileName);
    //$uploadFile->getListItemAllFields()->update();
    //$ctx->executeQuery();
}

function saveFile(ClientContext $ctx, $sourceFilePath, $targetFileUrl)
{
    $fileContent = file_get_contents($sourceFilePath);
    Office365\PHP\Client\SharePoint\File::saveBinary($ctx,$targetFileUrl,$fileContent);
    print "File has been uploaded\r\n";
}


function downloadFile(ClientRuntimeContext $ctx, $fileUrl, $targetFilePath){
    $fileContent = Office365\PHP\Client\SharePoint\File::openBinary($ctx,$fileUrl);
    file_put_contents($targetFilePath, $fileContent);
    print "File {$fileUrl} has been downloaded successfully\r\n";
}