<?php

require_once './../../vendor/autoload.php';
$settings = include('./../../../tests/Settings.php');


use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\FieldLookupValue;
use Office365\SharePoint\ListItem;

$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$siteUrl = $settings['TeamSiteUrl'];
$ctx = (new ClientContext($siteUrl))->withCredentials($credentials);

$list = $ctx->getWeb()->getLists()->getByTitle("Tasks");
$items = $list->getItems()->get()->top(1)->executeQuery();
if($items->getCount() !== 1){
    printf("Parent task not found");
    return;
}
$taskId = $items[0]->getProperty("Id");
$taskProps = array(
    'Title' => "New task N#" . rand(1, 100000),
    'ParentTask' => new FieldLookupValue($taskId)
);
$item = $list->addItem($taskProps)->executeQuery();
