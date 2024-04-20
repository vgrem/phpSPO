<?php

require_once '../vendor/autoload.php';

use Office365\GraphServiceClient;
use Office365\OneNote\Pages\OnenotePage;
use Office365\Runtime\Auth\AADTokenProvider;
use Office365\Runtime\Auth\UserCredentials;

$settings = include( '../../tests/Settings.php');
$client = GraphServiceClient::withUserCredentials(
    $settings['TenantName'], $settings['ClientId'], $settings['UserName'], $settings['Password']);

$pages = $client->getMe()->getOneNote()->getPages()->get()->executeQuery();
/** @var OnenotePage $page */
foreach ($pages as $page){
    echo "Page title: " . $page->getTitle();
}


