<?php

require_once __DIR__ . '/../vendor/autoload.php';
$settings = include(__DIR__ . '/../../Settings.php');


use Office365\Runtime\Auth\UserCredentials;
use Office365\SharePoint\ClientContext;



try {
    //1. Initialize SharePoint client with user credentials
    $credentials = new UserCredentials($settings['UserName'], $settings['Password']);
    $ctx = (new ClientContext($settings['Url']))->withCredentials($credentials);

    $site = $ctx->getSite();
    $ctx->load($site); //2. load Site resource
    $ctx->executeQuery();  //3. submit query to the server
    print $site->getUrl();
}
catch (Exception $e) {
	echo 'Authentication failed: ',  $e->getMessage(), "\n";
}
