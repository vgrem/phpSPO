<?php

require_once '../vendor/autoload.php';
$Settings = include('../../Settings.php');

use Office365\SharePoint\ClientContext;

$ctx = ClientContext::connectWithClientCredentials($Settings['Url'], $Settings['ClientId'], $Settings['ClientSecret']);

$list = $ctx->getWeb()->getLists()->getByTitle("Contacts_Large");
$items = $list->getItems();
$ctx->load($items);
$ctx->executeQuery();

print $items->getCount() . PHP_EOL;
foreach ($items as $index => $item){
    print($index . ":" . $item->getProperty('Title') . PHP_EOL);
}
