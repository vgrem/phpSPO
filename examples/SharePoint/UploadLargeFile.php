<?php

$settings = include('../../Settings.php');
require_once '../vendor/autoload.php';

use Office365\SharePoint\ClientContext;



try {
    $ctx = ClientContext::connectWithClientCredentials($settings['Url'], $settings['ClientId'], $settings['ClientSecret']);
    $localPath = "../data/big_buck_bunny.mp4";
    $targetLibraryTitle = "Documents";
    $targetList = $ctx->getWeb()->getLists()->getByTitle($targetLibraryTitle);

    $session = $targetList->getRootFolder()->getFiles()->createUploadSession($localPath, "big_buck_bunny.mp4",
    function ($uploadedBytes) {
        echo "Progress: $uploadedBytes bytes uploaded .." . PHP_EOL;
    });

    $ctx->executeQuery();
    $targetFileName = $session->getFile()->getName();
    echo "File $targetFileName has been uploaded.";

}
catch (Exception $e) {
    echo 'Error: ', $e->getMessage(), "\n";
}


