<?php

require_once '../vendor/autoload.php';
$settings = include('../../Settings.php');

use Office365\Graph\DriveItem;
use Office365\Graph\GraphServiceClient;
use Office365\Runtime\Auth\AuthenticationContext;
use Office365\Runtime\Auth\UserCredentials;


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

    $items = $client->getMe()->getDrive()->getRoot()->getChildren();
    $client->load($items);
    $client->executeQuery();
    /** @var DriveItem $file */
    foreach ($items as $item){
        print "Url:" . $item->getWebUrl() . PHP_EOL;
    }
}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}








