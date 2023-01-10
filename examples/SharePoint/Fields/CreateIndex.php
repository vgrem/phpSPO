<?php

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
    $result = $field->enableIndex()->executeQuery();
}



