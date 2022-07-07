<?php


use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\File;


require_once '../../vendor/autoload.php';
$settings = include('../../../tests/Settings.php');

$creds = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$ctx = (new ClientContext($settings['TeamSiteUrl']))->withCredentials($creds);

$lib_title = "Documents";
$lib = $ctx->getWeb()->getLists()->getByTitle($lib_title);
$folder = $lib->getRootFolder()->expand("Files")->get()->executeQuery();

/** @var File $file */
foreach ($folder->getFiles() as $file) {
    try {
        $localPath = join(DIRECTORY_SEPARATOR, [sys_get_temp_dir(), $file->getName()]);
        $fh = fopen($localPath, 'w+');
        $file->download($fh)->executeQuery();
        fclose($fh);
        print "File: {$file->getServerRedirectedUrl()} has been downloaded into {$localPath}\r\n";
    } catch (\Throwable $th) {
        print "Error {$th->getCode()} - File download failed: {$th->getMessage()}";
    }
}



