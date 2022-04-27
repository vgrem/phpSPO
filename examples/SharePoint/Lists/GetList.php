<?php


use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;

require_once '../../vendor/autoload.php';
$settings = include('../../../tests/Settings.php');

$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$client = (new ClientContext($settings['TeamSiteUrl']))->withCredentials($credentials);
//$list = $client->getWeb()->getLists()->getByTitle("Documents")->get()->executeQuery();
$list = $client->getWeb()->getList("/sites/team/Shared Documents")->executeQuery();
print_r($list->getTitle());