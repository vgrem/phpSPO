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
    /** @var DriveItem $item */
    foreach ($items as $item){
        if(!is_null($item->getFile())){
            print "Downloading file from url:" . $item->getWebUrl() . PHP_EOL;
            $fileName = join(DIRECTORY_SEPARATOR, [sys_get_temp_dir(), $item->getName()]);
            $fh = fopen($fileName, 'w+');
            $item->download($fh);
            $client->executeQuery();
            fclose($fh);
            print "[Ok] file downloaded: $fileName" . PHP_EOL;
        }
    }
}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}








