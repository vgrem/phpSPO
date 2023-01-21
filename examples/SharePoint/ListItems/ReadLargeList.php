<?php

require_once '../../vendor/autoload.php';
$settings = include('../../../tests/Settings.php');

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;

$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$siteUrl = $settings['TeamSiteUrl'];
$ctx = (new ClientContext($siteUrl))->withCredentials($credentials);

$list = $ctx->getWeb()->getLists()->getByTitle("Contacts_Large");

/*
$items = $list->getItems()->get()->paged(500, function ($returnType){
    print("{$returnType->getItemsCount()} items loaded...\n");
})->executeQuery();

foreach ($items as $index => $item){
    print($index . ":" . $item->getProperty('Title') . PHP_EOL);
}*/

//$totalItemsCount = $items->getCount();
//print($totalItemsCount);

$allItems = $list->getItems()->getAll()->paged(5000, function ($returnType){
    print("{$returnType->getPageInfo()} items loaded...\n");
})->executeQuery();


