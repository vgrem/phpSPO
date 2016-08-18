<?php

use SharePoint\PHP\Client\ClientContext;
use SharePoint\PHP\Client\ClientRuntimeContext;
use SharePoint\PHP\Client\SPList;

require_once(__DIR__ . '/../src/SharePoint/ClientContext.php');
require_once(__DIR__ . '/../src/Runtime/Auth/AuthenticationContext.php');
require_once(__DIR__ . '/../tests/TestUtilities.php');
require_once 'Settings.php';

global $Settings;

try {
    $authCtx = new SharePoint\PHP\Client\AuthenticationContext($Settings['Url']);
    $authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
    $ctx = new ClientContext($Settings['Url'],$authCtx);

    $localPath = "./data/";
    $targetLibraryTitle = "Documents";

    $list = TestUtilities::ensureList($ctx,$targetLibraryTitle,\SharePoint\PHP\Client\ListTemplateType::DocumentLibrary);
    uploadFiles($localPath,$list);
    processFiles($list,$localPath);
    //deleteFolder($ctx,$folderUrl);
    //saveFile($ctx,$localFilePath,$fileUrl);

}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
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

function uploadFiles($localPath,\SharePoint\PHP\Client\SPList $targetList){

    $ctx = $targetList->getContext();

    $searchPrefix = $localPath . '*.*';
    foreach(glob($searchPrefix) as $filename) {
        $fileCreationInformation = new \SharePoint\PHP\Client\FileCreationInformation();
        $fileCreationInformation->Content = file_get_contents($filename);
        $fileCreationInformation->Url = basename($filename);

        $uploadFile = $targetList->getRootFolder()->getFiles()->add($fileCreationInformation);
        $ctx->executeQuery();
        print "File {$uploadFile->getProperty('Name')} has been uploaded\r\n";
    }


}

function saveFile(ClientContext $ctx, $sourceFilePath, $targetFileUrl)
{
    $fileContent = file_get_contents($sourceFilePath);
    SharePoint\PHP\Client\File::saveBinary($ctx,$targetFileUrl,$fileContent);
    print "File has been uploaded\r\n";
}


function downloadFile(ClientRuntimeContext $ctx, $fileUrl, $targetFilePath){
    $fileContent = SharePoint\PHP\Client\File::openBinary($ctx,$fileUrl);
    file_put_contents($targetFilePath, $fileContent);
    print "File {$fileUrl} has been downloaded successfully\r\n";
}