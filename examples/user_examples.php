<?php

use SharePoint\PHP\Client\AuthenticationContext;
use SharePoint\PHP\Client\ClientContext;

require_once(__DIR__.'/../src/ClientContext.php');
require_once(__DIR__.'/../src/auth/AuthenticationContext.php');
require_once 'Settings.php';



try {
    $authCtx = new AuthenticationContext($Settings['Url']);
    $authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
    $ctx = new SharePoint\PHP\Client\ClientContext($Settings['Url'],$authCtx);

    getSiteUsers($ctx);

}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}



function getSiteUsers(ClientContext $ctx){

    $web = $ctx->getWeb();
    $users = $web->getSiteUsers();
    $ctx->load($users);
    $ctx->executeQuery();
    foreach( $users->getData() as $user ) {
        print "User title: '{$user->Title}'\r\n";
    }
}


