<?php

require_once '../vendor/autoload.php';
$settings = include('../../Settings.php');

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\CamlQuery;
use Office365\SharePoint\ClientContext;


$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$client = (new ClientContext($settings['Url'] . "/sites/team"))->withCredentials($credentials);

$list = $client->getWeb()->getLists()->getByTitle("Tasks");
$qry = new CamlQuery();
$qry->ViewXml = '<View><Query><Where><Eq><FieldRef Name="Editor" LookupId="TRUE" /><Value Type="Integer"><UserID /></Value></Eq></Where></Query></View>';
$items = $list->getItems($qry);
$client->load($items);
$client->executeQuery();

foreach ($items as $index => $item){
    print($index . ":" . $item->getProperty('Title') . PHP_EOL);
}
