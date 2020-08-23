<?php

$settings = include('../../Settings.php');
require_once '../vendor/autoload.php';

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;



try {
    $creds = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
    $ctx = (new ClientContext($settings['Url']))->withCredentials($creds);
    $localPath = "../data/big_buck_bunny.mp4";
    $targetLibraryTitle = "Documents";
    $targetList = $ctx->getWeb()->getLists()->getByTitle($targetLibraryTitle);

    $session = $targetList->getRootFolder()->getFiles()->createUploadSession($localPath, "big_buck_bunny.mp4",
    function ($uploadedBytes) {
        echo "Progress: $uploadedBytes bytes uploaded .." . PHP_EOL;
    });

    $ctx->executeQuery();
    $targetFileUrl = $session->getFile()->getServerRelativeUrl();
    echo "File $targetFileUrl has been uploaded.";

}
catch (Exception $e) {
    echo 'Error: ', $e->getMessage(), "\n";
}


