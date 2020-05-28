<?php

require_once '../vendor/autoload.php';
$Settings = include('../../Settings.php');

use Office365\SharePoint\CamlQuery;
use Office365\SharePoint\ClientContext;


$ctx = ClientContext::connectWithClientCredentials("https://mediadev8.sharepoint.com/", $Settings['ClientId'], $Settings['ClientSecret']);

$list = $ctx->getWeb()->getLists()->getByTitle("Tasks");
$qry = new CamlQuery();
$qry->ViewXml = '<View><Query><Where><Eq><FieldRef Name="Editor" LookupId="TRUE" /><Value Type="Integer"><UserID /></Value></Eq></Where></Query></View>';
$items = $list->getItems($qry);
$ctx->executeQuery();

foreach ($items as $index => $item){
    print($index . ":" . $item->getProperty('Title') . PHP_EOL);
}
