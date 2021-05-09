<?php

require_once '../vendor/autoload.php';

use Office365\GraphServiceClient;
use Office365\Runtime\Auth\AADTokenProvider;
use Office365\Runtime\Auth\UserCredentials;


function acquireToken()
{
    $settings = include('../../tests/Settings.php');
    $resource = "https://graph.microsoft.com";
    $provider = new AADTokenProvider($settings['TenantName']);
    return $provider->acquireTokenForPassword($resource, $settings['ClientId'],
        new UserCredentials($settings['UserName'], $settings['Password']));
}

try {
    $client = new GraphServiceClient("acquireToken");

    $targetFilePath = "./myprofile.png";
    $fp = fopen($targetFilePath, 'w+');
    $client->getMe()->getPhoto()->getContent($fp)->executeQuery();
    fclose($fp);
} catch (Exception $e) {
    echo 'Error: ', $e->getMessage(), "\n";
}







