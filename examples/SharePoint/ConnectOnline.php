<?php

require_once '../vendor/autoload.php';
$Settings = include('../../settings.php');


use Office365\SharePoint\ClientContext;



try {
    $ctx = ClientContext::connectWithUserCredentials($Settings['Url'], $Settings['UserName'], $Settings['Password']);
    //$ctx = ClientContext::connectWithClientCredentials($Settings['Url'], $Settings['ClientId'], $Settings['ClientSecret']);
    $site = $ctx->getSite();
    $ctx->load($site); //load site settings
    $ctx->executeQuery();
    print $site->getProperty("Url");
}
catch (Exception $e) {
	echo 'Authentication failed: ',  $e->getMessage(), "\n";
}
