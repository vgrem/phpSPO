<?php

require_once(__DIR__.'/../src/ClientContext.php');
require_once(__DIR__.'/../src/auth/AuthenticationContext.php');
require_once 'Settings.php';



try {
    $authCtx = new SharePoint\PHP\Client\AuthenticationContext($Settings['Url']);
    $authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
    $ctx = new SharePoint\PHP\Client\ClientContext($Settings['Url'],$authCtx);

    $fileUrl = "/sites/news/Documents/Guide.docx";
    $localFilePath = "./SharePoint User Guide.docx";

    //readFileFromLibrary($ctx);
    downloadFile($ctx,$fileUrl,$localFilePath);
    //uploadFile($ctx);
    //checkoutFile($ctx,$fileUrl);
    //checkinFile($ctx,$fileUrl);
    //approveFile($ctx,$fileUrl);

}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}


function checkoutFile(SharePoint\PHP\Client\ClientContext $ctx,$fileUrl){
    $file = $ctx->getWeb()->getFileByUrl($fileUrl);
    $file->checkOut();
    $ctx->executeQuery();
    print "File has been checked out\r\n";
}


function checkinFile(SharePoint\PHP\Client\ClientContext $ctx,$fileUrl){
    $file = $ctx->getWeb()->getFileByUrl($fileUrl);
    $file->checkIn('');
    $ctx->executeQuery();
    print "File has been checked in\r\n";
}

function approveFile(SharePoint\PHP\Client\ClientContext $ctx,$fileUrl){
    $file = $ctx->getWeb()->getFileByUrl($fileUrl);
    $file->approve('');
    $ctx->executeQuery();
    print "File {$fileUrl} has been approved\r\n";
}

function uploadFile(SharePoint\PHP\Client\ClientContext $ctx){

    $fileCreationInformation = array(
        'Content' => file_get_contents('./SharePoint User Guide.docx'),
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
    $file = $ctx->getWeb()->getFileByUrl($sourceFileUrl);
    $ctx->load($file);
    $ctx->executeQuery();
    print "File name: '{$file->Name}'\r\n";
}

?>