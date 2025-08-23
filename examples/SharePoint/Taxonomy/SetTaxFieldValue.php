<?php
require_once '../../../vendor/autoload.php';
$settings = include('./../../../tests/Settings.php');

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\Taxonomy\TaxonomyFieldValue;
use Office365\SharePoint\Taxonomy\TaxonomyFieldValueCollection;

$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$siteUrl = $settings['TeamSiteUrl'];
$ctx = (new ClientContext($siteUrl))->withCredentials($credentials);
$tasksList = $ctx->getWeb()->getLists()->getByTitle("Tasks");

$taxFieldValue = new TaxonomyFieldValue("Sweden", "f9a6dae9-633c-474b-b35e-b235cf2b9e73");
$taxFieldValueAlt = new TaxonomyFieldValue("Germany", "04872f90-9990-4fe4-8cff-32cc8ca05417");

$taskProps = array(
    'Title' => "New task N#" . rand(1, 100000),
    "Country" => $taxFieldValue,
    "Countries" => new TaxonomyFieldValueCollection(array($taxFieldValue, $taxFieldValueAlt))
);
$item = $tasksList->addItem($taskProps)->executeQuery();

print("List item created.");