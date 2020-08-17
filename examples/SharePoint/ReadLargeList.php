<?php

require_once '../vendor/autoload.php';
$Settings = include('../../Settings.php');

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;

$credentials = new ClientCredential($Settings['ClientId'], $Settings['ClientSecret']);
$siteUrl = $Settings['Url'] . "/sites/team";
$ctx = (new ClientContext($siteUrl))->withCredentials($credentials);

$list = $ctx->getWeb()->getLists()->getByTitle("Contacts_Large");
$items = $list->getItems();
$ctx->load($items);
$ctx->executeQuery();

print $items->getCount() . PHP_EOL;
foreach ($items as $index => $item){
    print($index . ":" . $item->getProperty('Title') . PHP_EOL);
}
