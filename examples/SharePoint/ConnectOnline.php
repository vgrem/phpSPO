<?php

require_once __DIR__ . '/../vendor/autoload.php';
$settings = include( __DIR__ . '/../../Settings.php');


use Office365\SharePoint\ClientContext;



try {
    $ctx = ClientContext::connectWithUserCredentials($settings['Url'], $settings['UserName'], $settings['Password']);
    //$ctx = ClientContext::connectWithClientCredentials($Settings['Url'], $Settings['ClientId'], $Settings['ClientSecret']);
    $site = $ctx->getSite();
    $ctx->load($site); //load site settings
    $ctx->executeQuery();
    print $site->getProperty("Url");
}
catch (Exception $e) {
	echo 'Authentication failed: ',  $e->getMessage(), "\n";
}
