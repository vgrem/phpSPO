<?php

use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
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
    $targetFolderUrl = "/sites/contoso/Documents/Archive/2017/08";

    $list = ListExtensions::ensureList($ctx->getWeb(),$targetLibraryTitle, \Office365\PHP\Client\SharePoint\ListTemplateType::DocumentLibrary);

    $folderUrl = "Shared Documents";
    $fileUrl = "Guide #123.docx";
    $file = $ctx->getWeb()->getFolders()->getByUrl($folderUrl)->getFiles()->getByUrl($fileUrl);
    $ctx->load($file);
    $ctx->executeQuery();
    print "File name: '{$file->getProperty("Name")}'\r\n";


    //downloadFile($ctx,$fileUrl,$localPath);
    //enumFolders($list);
    //uploadFiles($localPath,$list);
    //$localFilePath = realpath ($localPath . "/SharePoint User Guide.docx");
    //uploadFileIntoFolder($ctx,$localFilePath,$targetFolderUrl);
    //processFiles($list,$localPath);
    //deleteFolder($ctx,$folderUrl);
    //saveFile($ctx,$localFilePath,$fileUrl);
    //createSubFolder($ctx,$targetFolderUrl,"2001");



}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}



function downloadFileViaRPC(ClientContext $ctx,$webUrl,$fileUrl){
    $fileAbsUrl = $webUrl . rawurlencode($fileUrl);
    $options = new RequestOptions($fileAbsUrl);
    $data = $ctx->executeQueryDirect($options);
}

function createSubFolder(ClientContext $ctx,$parentFolderUrl,$folderName){

    $files = $ctx->getWeb()->getFolderByServerRelativeUrl($parentFolderUrl)->getFiles();
    $ctx->load($files);
    $ctx->executeQuery();
    //print files info
    foreach ($files->getData() as $file) {
        print "File name: '{$file->getProperty("ServerRelativeUrl")}'\r\n";
    }


    $parentFolder = $ctx->getWeb()->getFolderByServerRelativeUrl($parentFolderUrl);
    $childFolder = $parentFolder->getFolders()->add($folderName);
    $ctx->executeQuery();
    print "Child folder {$childFolder->getProperty("ServerRelativeUrl")} has been created ";
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
        //downloadFileAsStream($ctx,$file->ServerRelativeUrl,$fileName);
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
    print "File {$uploadFile->getProperty('ServerRelativeUrl')} has been uploaded\r\n";

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

function downloadFileAsStream(ClientRuntimeContext $ctx, $fileUrl, $targetFilePath) {
    $fileUrl = rawurlencode($fileUrl);

    $fp = fopen($targetFilePath, 'w+');
    $url = $ctx->getServiceRootUrl() . "web/getfilebyserverrelativeurl('$fileUrl')/\$value";
    $options = new \Office365\PHP\Client\Runtime\Utilities\RequestOptions($url);
    $options->StreamHandle = $fp;
    $ctx->executeQueryDirect($options);
    fclose($fp);

    print "File {$fileUrl} has been downloaded successfully\r\n";
}

function overwriteFileAsStream(ClientContext $ctx, $fileUrl, $sourceFilePath) {
    $fileUrl = rawurlencode($fileUrl);
    $fp = fopen($sourceFilePath, 'r');

    $url = $ctx->getServiceRootUrl() . "web/getfilebyserverrelativeurl('$fileUrl')/\$value";
    $options = new \Office365\PHP\Client\Runtime\Utilities\RequestOptions($url);
    $options->Method = \Office365\PHP\Client\Runtime\HttpMethod::Post;
    $options->addCustomHeader('X-HTTP-Method','PUT');
    $ctx->ensureFormDigest($options);
    $options->StreamHandle = $fp;
    $options->addCustomHeader("content-length", filesize($sourceFilePath));

    $ctx->executeQueryDirect($options);
    fclose($fp);
    print "File {$fileUrl} has been uploaded successfully\r\n";
}
