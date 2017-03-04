<?php

use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\Auth\OAuthTokenProvider;

require_once '../bootstrap.php';

global $AppSettings;
global $Settings;


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$authorityUrl = OAuthTokenProvider::$AuthorityUrl . $AppSettings['TenantName'];
$authCtx = new AuthenticationContext($authorityUrl);
$resource = "https://graph.windows.net";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['code'])) {
    //$authorizeUrl = "https://login.microsoftonline.com/{tenant}/oauth2/authorize";
    $authorizeUrl = "https://login.microsoftonline.com/common/oauth2/authorize";
    $authorizationUrl = $authCtx->getAuthorizationRequestUrl($authorizeUrl,$AppSettings['ClientId'],$AppSettings['RedirectUrl']);
    header('Location: ' . $authorizationUrl);
    exit();
}
elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['code'])) {

    $authorityUrl = "https://login.microsoftonline.com/common";
    try{
        $authCtx->acquireTokenByAuthorizationCode($authorityUrl,$resource,$AppSettings['ClientId'],$AppSettings['ClientSecret'],$_GET['code'],$AppSettings['RedirectUrl']);
        $accessToken = $authCtx->getAccessToken();
        $_SESSION['token_info'] = $accessToken->id_token_info;
        $_SESSION['token'] = $accessToken;
        $_SESSION['auth_ctx'] = $authCtx;
        header('Location: Index.php');
        exit();
    }
    catch (Exception $ex) {
        print 'Authentication failed:' . $ex->getMessage();
    }

}
else {
  print "Authentication failed: Invalid request";
}

