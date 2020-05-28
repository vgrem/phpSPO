<?php

require_once __DIR__ . '/../vendor/autoload.php';
$settings = include( __DIR__ . '/../../Settings.php');
use Office365\SharePoint\ClientContext;

try {
    $ctx = ClientContext::connectWithClientCredentials($settings['Url'], $settings['ClientId'], $settings['ClientSecret']);
    $whoami = $ctx->getWeb()->getCurrentUser();
    $ctx->load($whoami);
    $ctx->executeQuery();
    print $whoami->getLoginName();
}
catch (Exception $e) {
	echo 'Authentication failed: ',  $e->getMessage(), "\n";
}
