<?php

require_once '../vendor/autoload.php';
$settings = include('../../Settings.php');


use Office365\Graph\GraphServiceClient;
use Office365\Runtime\Auth\AuthenticationContext;
use Office365\Runtime\Auth\UserCredentials;


function acquireToken(AuthenticationContext $authCtx, $clientId, $userName, $password)
{
    $resource = "https://graph.microsoft.com";
    $authCtx->acquireTokenForPassword($resource,$clientId,new UserCredentials($userName, $password));
}

try {
    $client = new GraphServiceClient($settings['TenantName'], function (AuthenticationContext $authCtx) use ($settings) {
        acquireToken($authCtx, $settings['ClientId'], $settings['UserName'], $settings['Password']);
        //$authCtx->setAccessToken("--access token goes here--");
    });


    $targetFilePath = "./myprofile.png";
    $fp = fopen($targetFilePath, 'w+');
    $client->getMe()->getPhoto()->getContent($fp);
    $client->executeQuery();
    fclose($fp);
} catch (Exception $e) {
    echo 'Error: ', $e->getMessage(), "\n";
}







