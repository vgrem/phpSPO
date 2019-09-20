<?php


use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\Auth\NetworkCredentialContext;
use Office365\PHP\Client\SharePoint\ClientContext;

require_once '../bootstrap.php';
$Settings = include('../../Settings.php');


function connectWithNTLMAuth($url,$username,$password){
    $authCtx = new NetworkCredentialContext($username, $password);
    $authCtx->AuthType = CURLAUTH_NTLM;
    $ctx = new ClientContext($url,$authCtx);
    return $ctx;
}


function connectWithUserCredentials($url,$username,$password){
    $authCtx = new AuthenticationContext($url);
    $authCtx->acquireTokenForUser($username,$password);
    $ctx = new ClientContext($url,$authCtx);
    return $ctx;
}

function connectWithAppOnlyToken($url,$clientId,$clientSecret){
    $authCtx = new AuthenticationContext($url);
    $authCtx->acquireAppOnlyAccessToken($clientId,$clientSecret);
    $ctx = new ClientContext($url,$authCtx);
    return $ctx;
}

try {

    //$ctx = connectWithNTLMAuth($Settings['Url'], $Settings['UserName'], $Settings['Password']);
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
