<?php

$settings = include('../../Settings.php');
require_once '../vendor/autoload.php';

use Office365\SharePoint\ClientContext;
use Office365\SharePoint\File;
use Office365\SharePoint\FileCreationInformation;
use Office365\SharePoint\SPList;


try {
    $ctx = ClientContext::connectWithUserCredentials($settings['Url'],$settings['UserName'],$settings['Password']);
    $localPath = "../data/";
    $targetLibraryTitle = "Documents";
    $targetList = $ctx->getWeb()->getLists()->getByTitle($targetLibraryTitle);

    $searchPrefix = $localPath . '*.*';
    foreach(glob($searchPrefix) as $filename) {
        $uploadFile = uploadFile($filename,$targetList);
        print "File {$uploadFile->getProperty('Name')} has been uploaded\r\n";
    }

}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}


/**
 * @param string $localPath
 * @param SPList $targetList
 * @return File
 */
function uploadFile($localPath, $targetList)
{
    $ctx = $targetList->getContext();
    $fileCreationInformation = new FileCreationInformation();
    $fileCreationInformation->Content = file_get_contents($localPath);
    $fileCreationInformation->Url = basename($localPath);
    $uploadFile = $targetList->getRootFolder()->getFiles()->add($fileCreationInformation);
    $ctx->executeQuery();
    return $uploadFile;
}


function uploadFileAlt(ClientContext $ctx, $sourceFilePath, $targetFileUrl)
{
    $fileContent = file_get_contents($sourceFilePath);
    try {
        Office365\SharePoint\File::saveBinary($ctx, $targetFileUrl, $fileContent);
        print "File has been uploaded\r\n";
    } catch (Exception $e) {
        print "File upload failed:\r\n";
    }
}
