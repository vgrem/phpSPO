<?php

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\File;

$settings = include('../../Settings.php');
require_once '../vendor/autoload.php';

$appCreds = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$ctx = (new ClientContext($settings['Url']))->withCredentials($appCreds);
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




