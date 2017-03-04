<?php


use Office365\PHP\Client\OneNote\OneNoteClient;
use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\Auth\NetworkCredentialContext;
use Office365\PHP\Client\Runtime\Auth\OAuthTokenProvider;
use Office365\PHP\Client\Runtime\Utilities\ClientCredential;
use Office365\PHP\Client\Runtime\Utilities\UserCredentials;

require_once '../bootstrap.php';
global $AppSettings;
global $Settings;


try {
    $authorityUrl = OAuthTokenProvider::$AuthorityUrl . $AppSettings['TenantName'];
    //$authCtx = new AuthenticationContext($authorityUrl);
    //$clientCredentials = new ClientCredential($AppSettings['ClientId'],$AppSettings['ClientSecret']);
    //$authCtx->acquireTokenForClientCredential("https://graph.microsoft.com",$clientCredentials);
    //$userCredentials = new UserCredentials($Settings['UserName'],$Settings['Password']);
    //$authCtx->acquireTokenForUserCredential("https://graph.microsoft.com",$AppSettings['ClientId'],$AppSettings['ClientSecret'],$userCredentials);


    $authCtx = new NetworkCredentialContext($Settings['UserName'], $Settings['Password']);


    $context = new OneNoteClient($authCtx);
    $pages = $context->getMe()->getNotes()->getPages();
    $context->load($pages);
    $context->executeQuery();

    echo "Number of pages: " . $pages->getCount();
}
catch (Exception $e) {
    echo 'Authentication failed: ',  $e->getMessage(), "\n";
}