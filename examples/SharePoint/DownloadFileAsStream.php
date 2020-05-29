<?php

use Office365\SharePoint\ClientContext;
use Office365\SharePoint\File;

$settings = include('../../Settings.php');
require_once '../vendor/autoload.php';

$ctx = ClientContext::connectWithClientCredentials($settings['Url'], $settings['ClientId'], $settings['ClientSecret']);
$sourceLibraryTitle = "Documents";
$sourceList = $ctx->getWeb()->getLists()->getByTitle($sourceLibraryTitle);
$files = $sourceList->getRootFolder()->getFiles();
$ctx->load($files);
$ctx->executeQuery();

/** @var File $file */
foreach ($files as $file) {
    try {
        $fileName = join(DIRECTORY_SEPARATOR, [sys_get_temp_dir(), $file->getName()]);
        $fh = fopen($fileName, 'w+');
        $file->download($fh);
        $ctx->executeQuery();
        fclose($fh);
        print "File {$fileName} has been downloaded successfully\r\n";
    } catch (Exception $e) {
        print "File download failed:\r\n";
    }
}




