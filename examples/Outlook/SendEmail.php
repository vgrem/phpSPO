<?php


use Office365\OutlookServices\BodyType;
use Office365\OutlookServices\EmailAddress;
use Office365\OutlookServices\ItemBody;
use Office365\OutlookServices\OutlookClient;
use Office365\OutlookServices\Recipient;
use Office365\Runtime\Auth\AuthenticationContext;
use Office365\Runtime\Auth\UserCredentials;


require_once '../vendor/autoload.php';
$settings = include('../../Settings.php');

function acquireToken(AuthenticationContext $authCtx,$clientId,$userName,$password)
{
    $resource = "https://outlook.office365.com";
    try {
        $authCtx->acquireTokenForPassword($resource,
            $clientId,
            new UserCredentials($userName, $password));
    } catch (Exception $e) {
        print("Failed to acquire token");
    }
}

try {
    $client = new OutlookClient($settings['TenantName'],function (AuthenticationContext $authCtx) use($settings) {
        acquireToken($authCtx,$settings['ClientId'],$settings['UserName'], $settings['Password']);
        //$authCtx->setAccessToken("--access token goes here--");
    });
    $message = $client->getMe()->getMessages()->createMessage();
    $message->Subject = "Meet for lunch?";
    $message->Body = new ItemBody(BodyType::Text,"The new cafeteria is open.");
    $message->ToRecipients = array(
        new Recipient(new EmailAddress(null,"vgrem@mediadev8.onmicrosoft.com"))
    );
    $client->getMe()->sendEmail($message,true);
    $client->executeQuery();

}
catch (Exception $e) {
    echo 'Authentication failed: ',  $e->getMessage(), "\n";
}


