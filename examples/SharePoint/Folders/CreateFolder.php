<?php
require_once '../../vendor/autoload.php';
$settings = include('../../../tests/Settings.php');

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;

$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$siteUrl = $settings['TeamSiteUrl'];
$client = (new ClientContext($siteUrl))->withCredentials($credentials);

$folderName = "Archive_" . rand(1, 100000);
$rootFolder = $client->getWeb()->getFolderByServerRelativeUrl("Shared Documents");
$newFolder = $rootFolder->getFolders()->add($folderName)->executeQuery();
print($newFolder->getServerRelativeUrl());