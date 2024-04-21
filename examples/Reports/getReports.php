<?php


use Office365\GraphServiceClient;


require_once '../vendor/autoload.php';

$settings = include('../../tests/Settings.php');
$client = GraphServiceClient::withClientSecret($settings['TenantName'], $settings['ClientId'], $settings['ClientSecret']);
$result = $client->getReports()->getOffice365ActivationCounts()->executeQuery();
var_dump($result->getValue());

$result = $client->getReports()->getOffice365ActiveUserDetail("D7")->executeQuery();
var_dump($result->getValue());




