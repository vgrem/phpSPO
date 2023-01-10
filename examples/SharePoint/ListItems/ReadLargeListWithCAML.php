<?php

require_once '../../vendor/autoload.php';
$settings = include('../../../tests/Settings.php');

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\CamlQuery;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\ListItem;

$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$siteUrl = $settings['TeamSiteUrl'];
$ctx = (new ClientContext($siteUrl))->withCredentials($credentials);
$fieldName = "Modified";

$today = date("c");
$filterExpr = "$fieldName le datetime'$today'";

$list = $ctx->getWeb()->getLists()->getByTitle("Contacts_Large");

//ensure index for a field
$field = $list->getFields()->getByInternalNameOrTitle($fieldName)->get()->executeQuery();
if(!$field->getIndexed()){
   $result = $field->enableIndex()->executeQuery();
}

//retrieve items with filter
$items = $list->getItems()->get()->filter($filterExpr)->top(100)->executeQuery();

/*
$qry = new CamlQuery();
$qry->ViewXml = <<<XML
<View Scope='RecursiveAll'>
    <Query><Where><Le><FieldRef Name="Datum" /><Value Type="DateTime">${today}</Value></Le></Where></Query>
    <QueryOptions><QueryThrottleMode>Override</QueryThrottleMode></QueryOptions>
    <RowLimit Paged="TRUE">100</RowLimit>
</View>
XML;
$items = $list->getItems($qry)->executeQuery();
*/

/** @var ListItem $item */
foreach ($items as $index => $item){
    print($index . ":" . $item->getProperty('Title') . PHP_EOL);
}
