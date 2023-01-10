<?php

require_once '../../vendor/autoload.php';
$settings = include('../../../tests/Settings.php');

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\CamlQuery;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\ListItem;


$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$client = (new ClientContext($settings['Url'] . "/sites/team"))->withCredentials($credentials);

$list = $client->getWeb()->getLists()->getByTitle("Company Tasks");
$qry = new CamlQuery();
$qry->ViewXml = <<<XML
<View>
    <Query>
        <Where><Eq><FieldRef Name="Editor" LookupId="TRUE" /><Value Type="Integer"><UserID /></Value></Eq></Where>
    </Query>
</View>
XML;
$items = $list->getItems($qry)->executeQuery();

/** @var ListItem $item */
foreach ($items as $index => $item){
    print($index . ":" . $item->getProperty('Title') . PHP_EOL);
}
