<?php



use Office365\GraphServiceClient;
use Office365\Outlook\BodyType;
use Office365\Outlook\EmailAddress;
use Office365\Outlook\ItemBody;
use Office365\Outlook\Messages\FileAttachment;
use Office365\Outlook\Messages\Message;
use Office365\Runtime\Auth\AADTokenProvider;
use Office365\Runtime\Auth\UserCredentials;

require_once '../vendor/autoload.php';

function acquireToken()
{
    $resource = "https://graph.microsoft.com";
    $settings = include('../../tests/Settings.php');
    $provider = new AADTokenProvider($settings['TenantName']);
    return $provider->acquireTokenForPassword($resource, $settings['ClientId'],
        new UserCredentials($settings['UserName'], $settings['Password']));
}

$client = new GraphServiceClient("acquireToken");

/** @var Message $message */
$message = $client->getMe()->getMessages()->createType();
$message->setSubject("Meet for lunch?");
$message->setBody(new ItemBody(BodyType::Text,"The new cafeteria is open."));
$message->setToRecipients([new EmailAddress(null,"vvgrem@gmail.com")]);
$attachment = $message->addAttachment(FileAttachment::class);
$attachment->setContentBytes("bWFjIGFuZCBjaGVlc2UgdG9kYXk=");
$attachment->setIsInline(false);
$attachment->setName("attachment.txt");
$client->getMe()->sendEmail($message,false)->executeQuery();


