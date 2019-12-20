<?php


use Office365\PHP\Client\GraphClient\GraphServiceClient;
use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\Auth\OAuthTokenProvider;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use Office365\PHP\Client\Runtime\Utilities\UserCredentials;

require_once '../bootstrap.php';
$settings = include('../../Settings.php');


function acquireToken(AuthenticationContext $authCtx,$clientId,$userName,$password)
{
    $resource = "https://graph.microsoft.com";
    try {
        $authCtx->acquireTokenForPassword($resource,
            $clientId,
            new UserCredentials($userName,$password));
    } catch (Exception $e) {
        print("Failed to acquire token");
    }
}

try
{
    $client = new GraphServiceClient($settings['TenantName'],function (AuthenticationContext $authCtx) use($settings) {
        acquireToken($authCtx,$settings['ClientId'],$settings['UserName'], $settings['Password']);
        //$authCtx->setAccessToken("--access token goes here--");
    });
    //downloadMyProfilePhoto($client,"./myprofile.jpg");
    getMyDrive($client);
    //printMyOneNotePages($client);
}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}


function printMyOneNotePages(GraphServiceClient $client){
    $pages = $client->getMe()->getOneNote()->getPages();
    $client->load($pages);
    $client->executeQuery();
    echo "Number of pages: " . $pages->getCount();
}

function getMyDrive(GraphServiceClient $client){
    $drive = $client->getMe()->getDrive();
    $client->load($drive);
    $client->executeQuery();
    print $drive->getProperty("webUrl");
}


function downloadMyProfilePhoto(GraphServiceClient $client, $targetFilePath){
    $fp = fopen($targetFilePath, 'w+');
    //$url = $client->getServiceRootUrl() . "me/photo\$value";
    $url = $client->getServiceRootUrl() . "me/photo";
    $options = new RequestOptions($url);
    //$options->StreamHandle = $fp;
    try {
        $response = $client->executeQueryDirect($options);

    } catch (Exception $e) {
    }
    fclose($fp);
}






