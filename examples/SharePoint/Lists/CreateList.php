<?php


use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\ListCreationInformation;
use Office365\SharePoint\ListTemplateType;

require_once '../../vendor/autoload.php';
$settings = include('../../../tests/Settings.php');

$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$client = (new ClientContext($settings['TeamSiteUrl']))->withCredentials($credentials);

$listTitle = "Tasks";
$info = new ListCreationInformation($listTitle);
$info->BaseTemplate = ListTemplateType::Tasks;
$list =  $client->getWeb()->getLists()->add($info)->executeQuery();
print("List {$list->getTitle()} has been created.");

