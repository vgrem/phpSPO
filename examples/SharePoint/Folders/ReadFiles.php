<?php

require_once '../../vendor/autoload.php';
$settings = include('../../../Settings.php');


use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\File;
use Office365\SharePoint\Folder;

$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$siteUrl = $settings['Url'] . "/sites/team";
$ctx = (new ClientContext($siteUrl))->withCredentials($credentials);

function forEachFile(Folder $rootFolder, callable  $fn){
    /** @var File $file */
    foreach ($rootFolder->getFiles() as $file){
        $fn($file);
    }
    /** @var Folder $folder */
    foreach ($rootFolder->getFolders() as $folder){
        forEachFile($folder,$fn);
    }
}

$rootFolder = $ctx->getWeb()->getFolderByServerRelativeUrl("Shared Documents");
$files = $rootFolder->expand("Files")->get()->executeQuery();
forEachFile($files,function ($file){
  print($file->getName() . PHP_EOL);
});



