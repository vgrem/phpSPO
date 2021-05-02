<?php

require_once '../vendor/autoload.php';

use Office365\Graph\DriveItem;
use Office365\Graph\GraphServiceClient;
use Office365\Runtime\Auth\AADTokenProvider;
use Office365\Runtime\Auth\UserCredentials;


function acquireToken()
{
    $resource = "https://graph.microsoft.com";
    $settings = include('../../Settings.php');
    $provider = new AADTokenProvider($settings['TenantName']);
    return $provider->acquireTokenForPassword($resource, $settings['ClientId'],
        new UserCredentials($settings['UserName'], $settings['Password']));
}

try
{
    $client = new GraphServiceClient("acquireToken");

    $items = $client->getMe()->getDrive()->getRoot()->getChildren()->get()->executeQuery();
    /** @var DriveItem $item */
    foreach ($items as $item){
        if(!is_null($item->getFile())){
            print "Downloading file from url:" . $item->getWebUrl() . PHP_EOL;
            $fileName = join(DIRECTORY_SEPARATOR, [sys_get_temp_dir(), $item->getName()]);
            $fh = fopen($fileName, 'w+');
            $item->download($fh)->executeQuery();
            fclose($fh);
            print "[Ok] file downloaded: $fileName" . PHP_EOL;
        }
    }
}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}








