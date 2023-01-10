<?php

require_once './../../vendor/autoload.php';
$settings = include('./../../../tests/Settings.php');


use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\FieldLookupValue;
use Office365\SharePoint\FieldMultiChoiceValue;
use Office365\SharePoint\FieldMultiLookupValue;
use Office365\SharePoint\FieldUserValue;
use Office365\SharePoint\ListItem;

$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$siteUrl = $settings['TeamSiteUrl'];
$ctx = (new ClientContext($siteUrl))->withCredentials($credentials);

$list = $ctx->getWeb()->getLists()->getByTitle("Contacts_Large");
$items = $list->getItems()->get()->top(5)->executeQuery();
if($items->getCount() !== 5){
    printf("Parent task not found");
    return;
}

/** @var ListItem $item */
foreach($items as $item){
    $item->setProperty('Company', "Contoso")->update()->executeQuery();
}
