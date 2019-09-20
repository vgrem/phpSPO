<?php

use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use Office365\PHP\Client\SharePoint\ClientContext;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\SharePoint\File;
use Office365\PHP\Client\SharePoint\SPList;
require_once '../bootstrap.php';
$settings = include('../../Settings.php');

try {
    $authCtx = new AuthenticationContext($settings['Url']);
    $authCtx->acquireTokenForUser($settings['UserName'],$settings['Password']);
    $ctx = new ClientContext($settings['Url'],$authCtx);

    $localPath = "../data/";
    $targetLibraryTitle = "Documents";
    $targetFolderUrl = "Shared Documents";

    //$list = ListExtensions::ensureList($ctx->getWeb(),$targetLibraryTitle, \Office365\PHP\Client\SharePoint\ListTemplateType::DocumentLibrary);

    //Break role inheritance on the file.
    $fileUrl = "/Shared Documents/Book1.xlsx";
    $file = $ctx->getWeb()->getFileByServerRelativeUrl($fileUrl);
    $listItem = $file->getListItemAllFields();
    $listItem->breakRoleInheritance(false);
    $ctx->executeQuery();

    //get role definition
    $roleDefs = $ctx->getWeb()->getRoleDefinitions();
    $ctx->load($roleDefs);
    $ctx->executeQuery();


    //get site users
    $siteUsers = $ctx->getWeb()->getSiteUsers();
    $ctx->load($siteUsers);
    $ctx->executeQuery();


    //Add the new role assignment for the user on the file
    $targetRole = $roleDefs->findFirst("Name","Edit");
    $targetUser = $siteUsers->findFirst("Title","Marta Doe");
    $listItem->getRoleAssignments()->addRoleAssignment($targetUser->getProperty("Id"),$targetRole->getProperty("Id"));
    $ctx->executeQuery();
    print ("Done");

    /*$folderUrl = "Shared Documents";
    $fileUrl = "Guide #123.docx";
    $file = $ctx->getWeb()->getFolders()->getByUrl($folderUrl)->getFiles()->getByUrl($fileUrl);
    $ctx->load($file);
    $ctx->executeQuery();
    print "File name: '{$file->getProperty("Name")}'\r\n";*/


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
    print (strlen($data));
}

function createSubFolder(ClientContext $ctx,$parentFolderUrl,$folderName){

    $files = $ctx->getWeb()->getFolderByServerRelativeUrl($parentFolderUrl)->getFiles();
    $ctx->load($files);
    $ctx->executeQuery();
    //print files info
    /* @var $file File */
    foreach ($files->getData() as $file) {
        print "File name: '{$file->getProperty("ServerRelativeUrl")}'\r\n";
    }


    $parentFolder = $ctx->getWeb()->getFolderByServerRelativeUrl($parentFolderUrl);
    $childFolder = $parentFolder->getFolders()->add($folderName);
    $ctx->executeQuery();
    print "Child folder {$childFolder->getProperty("ServerRelativeUrl")} has been created ";
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
    try {
        Office365\PHP\Client\SharePoint\File::saveBinary($ctx, $targetFileUrl, $fileContent);
        print "File has been uploaded\r\n";
    } catch (Exception $e) {
        print "File upload failed:\r\n";
    }
}


function downloadFile(ClientRuntimeContext $ctx, $fileUrl, $targetFilePath){
    try {
        $fileContent = Office365\PHP\Client\SharePoint\File::openBinary($ctx, $fileUrl);
        file_put_contents($targetFilePath, $fileContent);
        print "File {$fileUrl} has been downloaded successfully\r\n";
    } catch (Exception $e) {
        print "File download failed:\r\n";
    }
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


function renameFolder($webUrl, $authCtx, $folderUrl,$folderNewName)
{
    $url = $webUrl . "/_api/web/getFolderByServerRelativeUrl('{$folderUrl}')/ListItemAllFields";
    $request = new RequestOptions($url);
    $ctx = new ClientContext($url,$authCtx);
    $resp = $ctx->executeQueryDirect($request);
    $data = json_decode($resp);

    $itemPayload = array(
        '__metadata' => array ('type' => $data->d->__metadata->type),
        'Title' => $folderNewName,
        'FileLeafRef' => $folderNewName
    );

    $itemUrl = $data->d->__metadata->uri;
    $request = new RequestOptions($itemUrl);
    $request->addCustomHeader("X-HTTP-Method", "MERGE");
    $request->addCustomHeader("If-Match", "*");
    $request->Data = $itemPayload;
    $ctx->executeQueryDirect($request);
}
