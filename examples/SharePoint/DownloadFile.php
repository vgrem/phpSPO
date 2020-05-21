<?php

use Office365\SharePoint\ClientContext;
use Office365\SharePoint\File;

$settings = include('../../Settings.php');
require_once '../vendor/autoload.php';

function downloadFileAlt(){
    //$fileContent = Office365\SharePoint\File::openBinary($ctx, $fileUrl);
}

$ctx = ClientContext::connectWithClientCredentials($settings['Url'],$settings['ClientId'], $settings['ClientSecret']);
$sourceLibraryTitle = "Documents";
$sourceList = $ctx->getWeb()->getLists()->getByTitle($sourceLibraryTitle);
$files = $sourceList->getRootFolder()->getFiles();
$ctx->load($files);
$ctx->executeQuery();

/** @var File $file */
foreach ($files->getData() as $file){
    try {
        $temp_file = join(DIRECTORY_SEPARATOR,[sys_get_temp_dir(),$file->getName()]);
        $result = $file->download();
        $ctx->executeQuery();
        file_put_contents($targetFilePath, $result->getValue());
        print "File {$file->getServerRelativeUrl()} has been downloaded successfully\r\n";
    } catch (Exception $e) {
        print "File download failed:\r\n";
    }
}




