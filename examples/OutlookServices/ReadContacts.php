<?php


use Office365\PHP\Client\OutlookServices\OutlookClient;
use Office365\PHP\Client\Runtime\Auth\OAuthTokenProvider;


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

    $authCtx = new \Office365\PHP\Client\Runtime\Auth\NetworkCredentialContext($Settings['UserName'],$Settings['Password']);

    $context = new OutlookClient($authCtx);
    $contacts = $context->getMe()->getContacts();
    $context->load($contacts);
    $context->executeQuery();

    foreach ($contacts->getData() as $contact){
        print $contact->GivenName . "\r\n";
    }

}
catch (Exception $e) {
    echo 'Authentication failed: ',  $e->getMessage(), "\n";
}


