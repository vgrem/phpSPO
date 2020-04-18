<?php

require_once '../vendor/autoload.php';
$settings = include('../../Settings.php');


use Office365\PHP\Client\GraphClient\GraphServiceClient;
use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use Office365\PHP\Client\Runtime\Utilities\UserCredentials;


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

try {
    $client = new GraphServiceClient($settings['TenantName'], function (AuthenticationContext $authCtx) use ($settings) {
        acquireToken($authCtx, $settings['ClientId'], $settings['UserName'], $settings['Password']);
        //$authCtx->setAccessToken("--access token goes here--");
    });


    $targetFilePath = "./myprofile.jpg";


    $fp = fopen($targetFilePath, 'w+');
    $url = $client->getServiceRootUrl() . "me/photo";
    $options = new RequestOptions($url);
    $options->StreamHandle = $fp;
    try {
        $client->executeQueryDirect($options);

    } catch (Exception $e) {
    }
    fclose($fp);


} catch (Exception $e) {
    echo 'Error: ', $e->getMessage(), "\n";
}







