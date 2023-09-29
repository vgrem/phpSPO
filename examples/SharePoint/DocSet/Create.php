<?php
require_once '../../vendor/autoload.php';
$settings = include('../../../tests/Settings.php');

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\DocumentManagement\DocumentSet\DocumentSet;

$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$siteUrl = $settings['TeamSiteUrl'];
$client = (new ClientContext($siteUrl))->withCredentials($credentials);

//$docSetName = "DocSet_" . rand(1, 100000);

$docSetName = "Customers";
$lib = $client->getWeb()->getLists()->getByTitle("HRDocs");
$docSet = DocumentSet::create($client, $lib->getRootFolder(), $docSetName)->executeQuery();
print($docSet->getProperty("ServerRelativeUrl"));


//2. retrieve document set by url (document sets addressed bý folder url)
$docSetUrl = "/sites/team/Shared Documents/Customers";
$docSet = $client->getWeb()->getFolderByServerRelativeUrl($docSetUrl)->get()->executeQuery();


//3. update document set
$folderUrl = "/sites/team/Shared Documents/Customers";
$docSet = $client->getWeb()->getFolderByServerRelativeUrl($folderUrl);
$docSet->getListItemAllFields()->setProperty("CustomerType", "New")->update()->executeQuery();


//4. delete document set
$docSetUrl = "/sites/team/Shared Documents/Customers";
$docSet = $client->getWeb()->getFolderByServerRelativeUrl($docSetUrl);
$docSet->deleteObject()->executeQuery();

