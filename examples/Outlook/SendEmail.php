<?php



use Office365\Graph\GraphServiceClient;
use Office365\OutlookServices\BodyType;
use Office365\OutlookServices\EmailAddress;
use Office365\OutlookServices\ItemBody;
use Office365\OutlookServices\Message;
use Office365\OutlookServices\Recipient;
use Office365\Runtime\Auth\AADTokenProvider;
use Office365\Runtime\Auth\UserCredentials;

require_once '../vendor/autoload.php';

function acquireToken()
{
    $resource = "https://graph.microsoft.com";
    $settings = include('../../Settings.php');
    $provider = new AADTokenProvider($settings['TenantName']);
    return $provider->acquireTokenForPassword($resource, $settings['ClientId'],
        new UserCredentials($settings['UserName'], $settings['Password']));
}

$client = new GraphServiceClient("acquireToken");

/** @var Message $message */
$message = $client->getMe()->getMessages()->createType();
$message->setSubject("Meet for lunch?");
$message->setBody(new ItemBody(BodyType::Text,"The new cafeteria is open."));
$message->getToRecipients()->addChild(new Recipient(new EmailAddress(null,"vgrem@mediadev8.onmicrosoft.com")));
$client->getMe()->sendEmail($message,false)->executeQuery();


