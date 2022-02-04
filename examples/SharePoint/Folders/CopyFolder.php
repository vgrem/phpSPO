<?php
require_once '../../vendor/autoload.php';
$settings = include('../../../tests/Settings.php');

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\MoveOperations;

$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$siteUrl = $settings['TeamSiteUrl'];
$client = (new ClientContext($siteUrl))->withCredentials($credentials);

$sourceFolder = $client->getWeb()->getFolderByServerRelativeUrl("Shared Documents/2020");
//$targetFolder = $sourceFolder->moveTo("Shared Documents/2021", MoveOperations::Overwrite)->executeQuery();
$targetFolder = $sourceFolder->copyTo("Shared Documents/2021", true)->executeQuery();
print($targetFolder->getServerRelativeUrl());