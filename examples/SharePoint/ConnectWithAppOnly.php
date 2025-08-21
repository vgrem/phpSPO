<?php

require_once __DIR__ . '/../../vendor/autoload.php';
$settings = include(__DIR__ . '/../../tests/Settings.php');


use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;

try {
    $credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
    $ctx = (new ClientContext($settings['Url']))->withCredentials($credentials);

    $whoami = $ctx->getWeb()->getCurrentUser()->get()->executeQuery();
    print $whoami->getLoginName();
}
catch (Exception $e) {
	echo 'Authentication failed: ',  $e->getMessage(), "\n";
}
