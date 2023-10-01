<?php
require_once '../../vendor/autoload.php';
$settings = include('../../../tests/Settings.php');

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\MoveOperations;
use Office365\SharePoint\SPResourcePath;

$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$siteUrl = $settings['TeamSiteUrl'];
$client = (new ClientContext($siteUrl))->withCredentials($credentials);

$folder = $client->getWeb()->getFolderByServerRelativePath("Shared Documents")->get()->executeQuery();
//$folder = $client->getWeb()->getFolderByServerRelativePath("Shared Documents")->get()->executeQuery();
print($folder->getServerRelativeUrl());