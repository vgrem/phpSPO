<?php


use Office365\GraphServiceClient;
use Office365\Outlook\Calendars\Calendar;
use Office365\Runtime\Auth\AADTokenProvider;
use Office365\Runtime\Auth\UserCredentials;

require_once '../vendor/autoload.php';

$settings = include('../../tests/Settings.php');
$client = GraphServiceClient::withUserCredentials(
    $settings['TenantName'], $settings['ClientId'], $settings['UserName'], $settings['Password']
);

$userCals = $client->getMe()->getCalendars()->get()->executeQuery();
/** @var Calendar $cal */
foreach ($userCals as $cal){
    echo "Calendar name: \n" . $cal->getName();
}



