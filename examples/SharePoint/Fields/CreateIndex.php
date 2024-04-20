<?php

/**
 * Creates an index to a list
 * Adding an index to a list or library column increases performance when you use filters
 */

require_once '../../vendor/autoload.php';
$settings = include('../../../tests/Settings.php');

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;

$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$siteUrl = $settings['TeamSiteUrl'];
$ctx = (new ClientContext($siteUrl))->withCredentials($credentials);
$fieldName = "Modified";

$list = $ctx->getWeb()->getLists()->getByTitle("Contacts_Large");

//ensure index for a field
$field = $list->getFields()->getByInternalNameOrTitle($fieldName)->get()->executeQuery();
if(!$field->getIndexed()){
    print("Enabling index for a field :" .  $fieldName . PHP_EOL);
    $result = $field->enableIndex()->executeQuery();
    print("Done" . PHP_EOL);
}
else{
    print("Index has already been enabled for a field: " . $fieldName .  PHP_EOL);
}



