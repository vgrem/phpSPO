<?php


use Office365\GraphServiceClient;
use Office365\Outlook\Calendars\Calendar;
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

$userCals = $client->getMe()->getCalendars()->get()->executeQuery();
/** @var Calendar $cal */
foreach ($userCals as $cal){
    echo "Calendar name: \n" . $cal->getName();
}



