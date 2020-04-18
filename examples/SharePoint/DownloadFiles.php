<?php

use Office365\PHP\Client\SharePoint\ClientContext;
use Office365\PHP\Client\SharePoint\File;

$settings = include('../../Settings.php');
require_once '../vendor/autoload.php';


$ctx = ClientContext::connectWithClientCredentials($settings['Url'],$Settings['ClientId'], $Settings['ClientSecret']);
$sourceLibraryTitle = "Documents";
$sourceList = $ctx->getWeb()->getLists()->getByTitle($sourceLibraryTitle);
$files = $sourceList->getRootFolder()->getFiles();
$ctx->load($files);
$ctx->executeQuery();


$targetFilePath = "../data";
/** @var File $file */
foreach ($files->getData() as $file){
    try {
        $fileUrl = $file->getServerRelativeUrl();
        $fileContent = Office365\PHP\Client\SharePoint\File::openBinary($ctx, $fileUrl);
        file_put_contents($targetFilePath, $fileContent);
        print "File {$fileUrl} has been downloaded successfully\r\n";
    } catch (Exception $e) {
        print "File download failed:\r\n";
    }
}




