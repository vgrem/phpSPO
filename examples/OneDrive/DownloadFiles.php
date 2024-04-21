<?php

require_once '../vendor/autoload.php';

use Office365\GraphServiceClient;
use Office365\OneDrive\DriveItems\DriveItem;


$settings = include('../../tests/Settings.php');
$client = GraphServiceClient::withUserCredentials(
    $settings['TenantName'], $settings['ClientId'], $settings['UserName'], $settings['Password']
);

$items = $client->getMe()->getDrive()->getRoot()->getChildren()->top(10)->get()->executeQuery();
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








