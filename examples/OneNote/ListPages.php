<?php

require_once '../vendor/autoload.php';
$settings = include('../../Settings.php');

use Office365\Graph\GraphServiceClient;
use Office365\Graph\OnenotePage;
use Office365\Runtime\Auth\AuthenticationContext;
use Office365\Runtime\Auth\UserCredentials;

function acquireToken(AuthenticationContext $authCtx, $clientId, $userName, $password)
{
    $resource = "https://graph.microsoft.com";
    try {
        $authCtx->acquireTokenForPassword($resource,
            $clientId,
            new UserCredentials($userName, $password));
    } catch (Exception $e) {
        print("Failed to acquire token");
    }
}


$client = new GraphServiceClient($settings['TenantName'],function (AuthenticationContext $authCtx) use($settings) {
    acquireToken($authCtx,$settings['ClientId'],$settings['UserName'], $settings['Password']);
    //or alternatively set access token: $authCtx->setAccessToken("--access token goes here--");
});

$pages = $client->getMe()->getOneNote()->getPages();
$client->load($pages);
$client->executeQuery();
/** @var OnenotePage $page */
foreach ($pages as $page){
    echo "Number of pages: " . $page->getTitle();
}


