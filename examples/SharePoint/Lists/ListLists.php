<?php
/**
 * List all available lists with their UUID and name
 */
use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;

require_once '../../vendor/autoload.php';
$settings = include('../../../tests/Settings.php');

$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$client = (new ClientContext($settings['TeamSiteUrl']))->withCredentials($credentials);

foreach ($client->getWeb()->getLists()->get()->executeQuery() as $list) {
    echo $list->getId() . ' ' . $list->getTitle() . "\n";
}
