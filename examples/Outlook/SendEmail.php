<?php


use Office365\OutlookServices\BodyType;
use Office365\OutlookServices\EmailAddress;
use Office365\OutlookServices\ItemBody;
use Office365\OutlookServices\OutlookClient;
use Office365\OutlookServices\Recipient;
use Office365\Runtime\Auth\OAuthTokenProvider;
use Office365\Runtime\Auth\UserCredentials;

require_once '../vendor/autoload.php';

function acquireToken()
{
    $resource = "https://outlook.office365.com";
    $settings = include('../../Settings.php');
    $provider = new OAuthTokenProvider($settings['TenantName']);
    return $provider->acquireTokenForPassword($resource, $settings['ClientId'],
        new UserCredentials($settings['UserName'], $settings['Password']));
}

try {
    $client = new OutlookClient("acquireToken");
    $message = $client->getMe()->getMessages()->createMessage();
    $message->Subject = "Meet for lunch?";
    $message->Body = new ItemBody(BodyType::Text,"The new cafeteria is open.");
    $message->ToRecipients = array(
        new Recipient(new EmailAddress(null,"vgrem@mediadev8.onmicrosoft.com"))
    );
    $client->getMe()->sendEmail($message,true)->executeQuery();
}
catch (Exception $e) {
    echo 'Authentication failed: ',  $e->getMessage(), "\n";
}


