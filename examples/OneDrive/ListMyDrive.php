<?php

require_once '../vendor/autoload.php';
$settings = include('../../Settings.php');


use Office365\PHP\Client\GraphClient\GraphServiceClient;
use Office365\PHP\Client\OneDrive\Item;
use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\Auth\UserCredentials;


function acquireToken(AuthenticationContext $authCtx,$clientId,$userName,$password)
{
    $resource = "https://graph.microsoft.com";
    try {
        $authCtx->acquireTokenForPassword($resource,
            $clientId,
            new UserCredentials($userName,$password));
    } catch (Exception $e) {
        print("Failed to acquire token");
    }
}

try
{
    $client = new GraphServiceClient($settings['TenantName'],function (AuthenticationContext $authCtx) use($settings) {
        acquireToken($authCtx,$settings['ClientId'],$settings['UserName'], $settings['Password']);
        //$authCtx->setAccessToken("--access token goes here--");
    });

    $files = $client->getMe()->getDrive()->getFiles();
    $client->load($files);
    $client->executeQuery();
    /** @var Item $file */
    foreach ($files as $fileItem){
        print $fileItem->getProperty("webUrl");
    }
}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}








