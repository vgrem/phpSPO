<?php

require_once __DIR__ . '/../vendor/autoload.php';
$settings = include(__DIR__ . '/../../Settings.php');

use Office365\Runtime\Auth\ClientCredential;
use Office365\Runtime\Http\RequestOptions;
use Office365\Runtime\ResourcePath;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\Web;

try {
    $credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
    $ctx = (new ClientContext($settings['Url']))->withCredentials($credentials);

    //1. construct a custom request
    $url = "{$ctx->getBaseUrl()}/_api/web";
    $request = new RequestOptions($url);
    //2. submit a request
    $resp = $ctx->getPendingRequest()->executeQueryDirect($request);
    $json = json_decode($resp->getContent(),true);
    // 3. map response to model entity
    $resultWeb = new Web($ctx,new ResourcePath("Web"));
    $ctx->getPendingRequest()->mapJson($json,$resultWeb,$ctx->getPendingRequest()->getFormat());
    print $resultWeb->getTitle();
}
catch (Exception $e) {
    echo 'Failed: ',  $e->getMessage(), "\n";
}
