<?php


use Office365\GraphServiceClient;
use Office365\Runtime\Auth\AADTokenProvider;
use Office365\Runtime\Auth\ClientCredential;


require_once '../vendor/autoload.php';

function acquireToken()
{
    $resource = "https://graph.microsoft.com";
    $settings = include('../../tests/Settings.php');
    $provider = new AADTokenProvider($settings['TenantName']);
    return $provider->acquireTokenForClientCredential($resource,
        new ClientCredential($settings['ClientId'], $settings['ClientSecret']),["/.default"]);
}

$client = new GraphServiceClient("acquireToken");
$result = $client->getReports()->getOffice365ActivationCounts()->executeQuery();
var_dump($result->getValue());

$result = $client->getReports()->getOffice365ActiveUserDetail("D7")->executeQuery();
var_dump($result->getValue());




