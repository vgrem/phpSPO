<?php

require_once './../../vendor/autoload.php';
$settings = include('./../../../tests/Settings.php');


use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\ListItem;

$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$siteUrl = $settings['TeamSiteUrl'];
$ctx = (new ClientContext($siteUrl))->withCredentials($credentials);

$list = $ctx->getWeb()->getLists()->getByTitle("Documents");
$items = $list->getItems()->select(["Author/Name", "Author/Title","FileRef"])->expand(["Author"])->get()->top(10)->executeQuery();

/** @var ListItem $item */
foreach ($items as $item){
    print("Url:" . $item->getProperty('FileRef') .  " Author:" . $item->getProperty('Author')["Name"] . PHP_EOL);
}
