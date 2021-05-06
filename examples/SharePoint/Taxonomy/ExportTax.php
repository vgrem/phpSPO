<?php

require_once '../../vendor/autoload.php';

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\Taxonomy\TaxonomyService;
use Office365\SharePoint\Taxonomy\TermGroup;

$settings = include('../../../Settings.php');
$appPrincipal = new ClientCredential($settings['ClientId'],$settings['ClientSecret']);
$ctx = (new ClientContext($settings['Url']))->withCredentials($appPrincipal);
$taxSvc = new TaxonomyService($ctx);
$groups = $taxSvc->getTermStore()->getTermGroups()->get()->executeQuery();

$fp = fopen('./SiteTaxonomy.csv', 'w');

/** @var TermGroup $group */
foreach ($groups as $group){
    fputcsv($fp, $group->toJson());
}

fclose($fp);