<?php

require_once __DIR__ . '/../../vendor/autoload.php';
$settings = include(__DIR__ . '/../../../tests/Settings.php');

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\Portal\SPSiteManager;

try {
    $credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
    $ctx = (new ClientContext($settings['Url']))->withCredentials($credentials);

    $siteManager = new SPSiteManager($ctx);
    //create communications site
    //refer https://docs.microsoft.com/en-us/sharepoint/dev/apis/site-creation-rest for docs
    $result = $siteManager->create("commsite127", $settings['TestAccountName'], "Low Business Impact");
    $siteManager->executeQuery();
    print("Site has been created: {$result->getValue()->SiteUrl} \n");
}
catch (Exception $e) {
    echo 'Failed: ',  $e->getMessage(), "\n";
}
