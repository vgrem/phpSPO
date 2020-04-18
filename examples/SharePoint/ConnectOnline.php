<?php

require_once '../vendor/autoload.php';
$Settings = include('../../settings.php');

use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\SharePoint\ClientContext;

function connectWithUserCredentials($url,$username,$password){
    $authCtx = new AuthenticationContext($url);
    $authCtx->acquireTokenForUser($username,$password);
    return new ClientContext($url,$authCtx);
}

function connectWithAppOnlyToken($url,$clientId,$clientSecret){
    $authCtx = new AuthenticationContext($url);
    $authCtx->acquireAppOnlyAccessToken($clientId,$clientSecret);
    return new ClientContext($url,$authCtx);
}

try {
    //$ctx = connectWithUserCredentials($Settings['Url'], $Settings['UserName'], $Settings['Password']);
    $ctx = connectWithAppOnlyToken($Settings['Url'], $Settings['ClientId'], $Settings['ClientSecret']);
    $site = $ctx->getSite();
    $ctx->load($site); //load site settings
    $ctx->executeQuery();
    print $site->getProperty("Url");
}
catch (Exception $e) {
	echo 'Authentication failed: ',  $e->getMessage(), "\n";
}
