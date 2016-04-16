<?php

require_once(__DIR__.'/../src/ClientContext.php');
require_once(__DIR__.'/../src/auth/AuthenticationContext.php');
require_once 'Settings.php';



try {
    $authCtx = new SharePoint\PHP\Client\AuthenticationContext($Settings['Url']);
    $authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
    $ctx = new SharePoint\PHP\Client\ClientContext($Settings['Url'],$authCtx);

    $fileUrl = "/sites/news/Documents/SharePoint User Guide.docx";
    $localFilePath = "./SharePoint User Guide.docx";
    $folderUrl = "/sites/news/Documents/Archive";
    $folderName = "Archive2014";

    //readFileFromLibrary($ctx);
    //downloadFile($ctx,$fileUrl,$localFilePath);
    //uploadFile($ctx,$localFilePath,$fileUrl);
    //checkoutFile($ctx,$fileUrl);
    //checkinFile($ctx,$fileUrl);
    //approveFile($ctx,$fileUrl);
    //deleteFolder($ctx,$folderUrl);
    saveFile($ctx,$localFilePath,$fileUrl);

}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}



function deleteFolder(SharePoint\PHP\Client\ClientContext $ctx,$folderUrl){
    $folder = $ctx->getWeb()->getFolderByServerRelativeUrl($folderUrl);
    $folder->deleteObject();
    $ctx->executeQuery();
    print "Folder has been deleted\r\n";
}


function checkoutFile(SharePoint\PHP\Client\ClientContext $ctx,$fileUrl){
    $file = $ctx->getWeb()->getFileByServerRelativeUrl($fileUrl);
    $file->checkOut();
    $ctx->executeQuery();
    print "File has been checked out\r\n";
}


function checkinFile(SharePoint\PHP\Client\ClientContext $ctx,$fileUrl){
    $file = $ctx->getWeb()->getFileByServerRelativeUrl($fileUrl);
    $file->checkIn('');
    $ctx->executeQuery();
    print "File has been checked in\r\n";
}

function approveFile(SharePoint\PHP\Client\ClientContext $ctx,$fileUrl){
    $file = $ctx->getWeb()->getFileByServerRelativeUrl($fileUrl);
    $file->approve('');
    $ctx->executeQuery();
    print "File {$fileUrl} has been approved\r\n";
}

function uploadFile(SharePoint\PHP\Client\ClientContext $ctx,$localFilePath,$fileUrl){

    $fileCreationInformation = array(
        'Content' => file_get_contents($localFilePath),
        'Url' => 'SharePoint User Guide.docx'
    );

    $list = $ctx->getWeb()->getLists()->getByTitle("Documents");
    $uploadFile = $list->getRootFolder()->getFiles()->add($fileCreationInformation);
    $ctx->executeQuery();
    print "File {$uploadFile->Name} has been uploaded\r\n";
}


function saveFile(SharePoint\PHP\Client\ClientContext $ctx,$sourceFilePath,$targetFileUrl)
{
    $fileContent = file_get_contents($sourceFilePath);
    SharePoint\PHP\Client\File::saveBinary($ctx,$targetFileUrl,$fileContent);
    print "File has been uploaded\r\n";
}


function downloadFile(SharePoint\PHP\Client\ClientContext $ctx,$sourcefileUrl,$targetFilePath){
    $fileContent = SharePoint\PHP\Client\File::openBinary($ctx,$sourcefileUrl);
    file_put_contents($targetFilePath, $fileContent);
    print "File has been downloaded\r\n";
}

function readFileFromLibrary(SharePoint\PHP\Client\ClientContext $ctx){
    $sourceFileUrl = "/sites/news/Documents/SharePoint User Guide.docx";
    $file = $ctx->getWeb()->getFileByServerRelativeUrl($sourceFileUrl);
    $ctx->load($file);
    $ctx->executeQuery();
    print "File name: '{$file->Name}'\r\n";
}

?>