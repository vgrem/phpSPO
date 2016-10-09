<?php


use Office365\PHP\Client\GraphClient\ActiveDirectoryClient;
use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\Auth\OAuthTokenProvider;
use Office365\PHP\Client\Runtime\Utilities\ClientCredential;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use Office365\PHP\Client\Runtime\Utilities\UserCredentials;

global $AppSettings;
global $Settings;
require_once '../bootstrap.php';

try
{
    $authorityUrl = OAuthTokenProvider::$AuthorityUrl . $AppSettings['TenantName'];
    $authCtx = new AuthenticationContext($authorityUrl);
    $authCtx->acquireTokenForUserCredential("https://graph.microsoft.com",$AppSettings['ClientId'],new UserCredentials($Settings['UserName'],$Settings['Password']));
    //$authCtx->acquireTokenForClientCredential("https://graph.microsoft.com",new ClientCredential($AppSettings['ClientId'],$AppSettings['ClientSecret']));
    $serviceRootUrl = "https://graph.windows.net/" . $AppSettings['TenantName'] . "/";
    $client = new ActiveDirectoryClient($serviceRootUrl,$authCtx);
    //$tenantDetails = $client->getTenantDetails();
    //$client->load($tenantDetails);
    //$client->executeQuery();


    $request = new RequestOptions("https://graph.windows.net/media18.onmicrosoft.com/users");
    $request->Url .= "?api-version=1.0";
    $response = $client->executeQueryDirect($request);
    print "Ok";
}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}