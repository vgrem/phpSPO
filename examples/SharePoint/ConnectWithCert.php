<?php

/**
 * Demonstrates how to authenticate SharePoint API via client certificate flow
 *
 * Steps:
 * 1. generate Self-Signed SSL Certificate
 *    - generate a private key:  openssl genrsa -out private.key 2048
 *    - generate a public key:  openssl req -new -x509 -key private.key -out publickey.cer -days 365
 * 2. upload the publickey.cer to your app in the Azure portal
 * 3. note the displayed thumbprint for the certificate
 * 4. initialize ClientContext instance and pass thumbprint and the contents of private.key
 *    along with tenantName and clientId into withClientCertificate method
 *
 * Documentation: https://learn.microsoft.com/en-us/sharepoint/dev/solution-guidance/security-apponly-azuread
 */

require_once __DIR__ . '/../vendor/autoload.php';
$settings = include(__DIR__ . './../../tests/Settings.php');

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;

try {

    $thumbprint = "054343442AC255DD07488910C7E000F92227FD98";
    $privateKey = file_get_contents("./private.key");

    $credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
    $ctx = (new ClientContext($settings['Url']))->withClientCertificate(
        $settings['TenantName'], $settings['ClientId'], $privateKey, $thumbprint);

    $whoami = $ctx->getWeb()->getCurrentUser()->get()->executeQuery();
    print $whoami->getLoginName();
}
catch (Exception $e) {
	echo 'Authentication failed: ',  $e->getMessage(), "\n";
}
