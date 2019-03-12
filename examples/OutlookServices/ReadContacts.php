<?php


use Office365\PHP\Client\OutlookServices\OutlookClient;
use Office365\PHP\Client\Runtime\Auth\OAuthTokenProvider;


require_once '../bootstrap.php';
$settings = include('../../Settings.php');

try {
    $authorityUrl = OAuthTokenProvider::$AuthorityUrl . $settings['TenantName'];
    $authCtx = new \Office365\PHP\Client\Runtime\Auth\NetworkCredentialContext($settings['UserName'],$settings['Password']);

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


