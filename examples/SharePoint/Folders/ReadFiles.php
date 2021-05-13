<?php

require_once '../../vendor/autoload.php';
$settings = include('../../../tests/Settings.php');


use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\File;
use Office365\SharePoint\Folder;

$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$siteUrl = $settings['Url'];
$ctx = (new ClientContext($siteUrl))->withCredentials($credentials);

function forEachFile(Folder $parentFolder, $recursive, callable  $action, $level=0)
{
    $files = $parentFolder->getFiles()->get()->executeQuery();
    /** @var File $file */
    foreach ($files as $file) {
        $action($file, $level);
    }

    if ($recursive) {
        /** @var Folder $folder */
        foreach ($parentFolder->getFolders() as $folder) {
            forEachFile($folder, $recursive, $action, $level++);
        }
    }
}

$rootFolder = $ctx->getWeb()->getFolderByServerRelativeUrl("Shared Documents");
forEachFile($rootFolder, true, function (File $file,$level){
  print($level . ":" . $file->getServerRelativeUrl() . PHP_EOL);
});



