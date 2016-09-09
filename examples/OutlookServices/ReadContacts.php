<?php


use Office365\PHP\Client\OutlookServices\OutlookClient;
use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\Auth\OAuthTokenProvider;
use Office365\PHP\Client\Runtime\Utilities\UserCredentials;


require_once '../bootstrap.php';
global $AppSettings;
global $Settings;

try {
    $authorityUrl = OAuthTokenProvider::$AuthorityUrl . $AppSettings['TenantName'];
    $authCtx = new AuthenticationContext($authorityUrl);
    //$authCtx->acquireTokenForClientCredential(OAuthTokenProvider::$ResourceId,$AppSettings['ClientId'],$AppSettings['ClientSecret']);
    $userCredentials = new UserCredentials($Settings['UserName'],$Settings['Password']);
    $authCtx->acquireTokenForUserCredential(OAuthTokenProvider::$ResourceId,$AppSettings['ClientId'],$userCredentials);
    $context = new OutlookClient($authCtx);
    $contacts = $context->getMe()->getContacts();
    $context->load($contacts);
    $context->executeQuery();

    foreach ($contacts->getData() as $contact){
        print $contact->Name;
    }

}
catch (Exception $e) {
    echo 'Authentication failed: ',  $e->getMessage(), "\n";
}


