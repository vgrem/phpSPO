<?php

require_once '../vendor/autoload.php';
$Settings = include('../../Settings.php');


use Office365\SharePoint\ClientContext;
use Office365\SharePoint\ListItem;

$ctx = ClientContext::connectWithClientCredentials($Settings['Url'], $Settings['ClientId'], $Settings['ClientSecret']);

$list = $ctx->getWeb()->getLists()->getByTitle("Tasks");
$items = $list->getItems();
$ctx->load($items);
$ctx->executeQuery();

/** @var ListItem $item */
foreach ($items as $item){
    print($item->getProperty('Title') . PHP_EOL);
}
