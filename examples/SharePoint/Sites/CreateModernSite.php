<?php

require_once __DIR__ . '../../vendor/autoload.php';
$settings = include(__DIR__ . '../../../Settings.php');

use Office365\Runtime\Auth\ClientCredential;
use Office365\Runtime\Http\RequestOptions;
use Office365\SharePoint\ClientContext;

try {
    $credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
    $ctx = (new ClientContext($settings['Url']))->withCredentials($credentials);

    $url = "{$ctx->getBaseUrl()}/_api/SPSiteManager/create";
    $request = new RequestOptions($url);
    $payload = array(
        "request" => array(
            "Title" => "Communication Site 1",
            "Url" => "{$ctx->getBaseUrl()}/sites/commsite2",
            "Lcid" => 1033,
            "ShareByEmailEnabled" => false,
            "Classification" => "Low Business Impact",
            "Description" => "Description",
            "WebTemplate" => "SITEPAGEPUBLISHING#0",
            "SiteDesignId" => "6142d2a0-63a5-4ba0-aede-d9fefca2c767",
            "Owner" => $settings['TestAccounts'][0]
        )
    );
    $request->Data = json_encode($payload);
    $resp = $ctx->getPendingRequest()->executeQueryDirect($request);
    $json = json_decode($resp->getContent(), true);
    print("Site has been created: {$json["d"]["Create"]["SiteUrl"]} \n");
}
catch (Exception $e) {
    echo 'Failed: ',  $e->getMessage(), "\n";
}
