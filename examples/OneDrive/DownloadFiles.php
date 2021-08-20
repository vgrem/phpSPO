<?php

require_once '../vendor/autoload.php';

use Office365\GraphServiceClient;
use Office365\OneDrive\DriveItems\DriveItem;
use Office365\Runtime\Auth\AADTokenProvider;
use Office365\Runtime\Auth\UserCredentials;


function acquireToken()
{
    $resource = "https://graph.microsoft.com";
    $settings = include('../../tests/Settings.php');
    $provider = new AADTokenProvider($settings['TenantName']);
    return $provider->acquireTokenForPassword($resource, $settings['ClientId'],
        new UserCredentials($settings['UserName'], $settings['Password']));
}

$client = new GraphServiceClient("acquireToken");

$items = $client->getMe()->getDrive()->getRoot()->getChildren()->get()->executeQuery();
/** @var DriveItem $item */
foreach ($items as $item){
    if($item->isFile()){
        print "Downloading file from url:" . $item->getWebUrl() . PHP_EOL;
        $fileName = join(DIRECTORY_SEPARATOR, [sys_get_temp_dir(), $item->getName()]);
        $fh = fopen($fileName, 'w+');
        $item->download($fh)->executeQuery();
        fclose($fh);
        print "[Ok] file downloaded: $fileName" . PHP_EOL;
    }
}








