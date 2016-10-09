<?php
use Office365\PHP\Client\GraphClient\ActiveDirectoryClient;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;

require_once '../bootstrap.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['auth_ctx'])) {

    if (isset($_GET['text'])) {
        $requestUrl = $_GET['text'];
        $authorityUrl = "https://graph.windows.net/";
        $client = new ActiveDirectoryClient($authorityUrl,$_SESSION['auth_ctx']);
        $request = new RequestOptions($requestUrl);
        $request->Url .= "?api-version=1.0";
        $response = $client->executeQueryDirect($request);
        echo $response;
    }
    else
        echo "Query is missing or invalid";
}
else {
    echo "Request failed: ";
}

