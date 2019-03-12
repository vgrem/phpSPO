<?php


use Office365\PHP\Client\GraphClient\GraphServiceClient;
use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\Auth\OAuthTokenProvider;
use Office365\PHP\Client\Runtime\Utilities\UserCredentials;

require_once '../bootstrap.php';

try
{
    $client = getAuthenticatedClient();
    //downloadPhoto($client,"./myprofile.jpg");
    getDriveInfo($client);

}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}


function getDriveInfo(GraphServiceClient $client){
    $drive = $client->getMe()->getDrive();
    $client->load($drive);
    $client->executeQuery();
    print $drive->getProperty("webUrl");
}


function downloadPhoto(GraphServiceClient $client,$targetFilePath){
    $fp = fopen($targetFilePath, 'w+');
    //$url = $client->getServiceRootUrl() . "me/photo\$value";
    $url = $client->getServiceRootUrl() . "me/photo";
    $options = new \Office365\PHP\Client\Runtime\Utilities\RequestOptions($url);
    //$options->StreamHandle = $fp;
    try {
        $content = $client->executeQueryDirect($options);

    } catch (Exception $e) {
    }
    fclose($fp);
}


/**
 * @return GraphServiceClient
 * @throws Exception
 */
function getAuthenticatedClient(){
    $settings = include('../../Settings.php');
    $resource = "https://graph.microsoft.com";
    $authorityUrl = OAuthTokenProvider::$AuthorityUrl . $settings['TenantName'];
    $authCtx = new AuthenticationContext($authorityUrl);
    $authCtx->acquireTokenForPassword($resource, $settings['ClientId'], new UserCredentials($settings['UserName'], $settings['Password']));
    $client = new GraphServiceClient($authCtx);
    return $client;
}



