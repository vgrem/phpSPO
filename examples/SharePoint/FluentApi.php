<?php

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;


$settings = include(__DIR__ . './../../tests/Settings.php');
require_once '../vendor/autoload.php';

$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$client = (new ClientContext($settings['Url']))->withCredentials($credentials);

$web = $client->getWeb()->get()->executeQuery();
$me = $client->getWeb()->getCurrentUser()->get()->executeQuery();

print "Web title: {$web->getTitle()}\r\n";
print "Current user name: {$me->getLoginName()}\r\n";


