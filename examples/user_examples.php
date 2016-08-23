<?php

use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\SharePoint\ClientContext;

require_once(__DIR__ . '/../src/SharePoint/ClientContext.php');
require_once(__DIR__ . '/../src/Runtime/Auth/AuthenticationContext.php');
require_once 'Settings.php';
global $Settings;

try {
    $authCtx = new AuthenticationContext($Settings['Url']);
    $authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
    $ctx = new ClientContext($Settings['Url'],$authCtx);

    getSiteUsers($ctx);
    getUser($ctx);
    updateUser($ctx);

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


function getUser(ClientContext $ctx){

    $web = $ctx->getWeb();
    $user = $web->getSiteUsers()->getById(3);
    $ctx->load($user);
    $ctx->executeQuery();
    print "User title: '{$user->Title}'\r\n";
}

function updateUser(ClientContext $ctx){

    $web = $ctx->getWeb();
    $user = $web->getSiteUsers()->getById(3);
    $user->setProperty('Title','John Doe');
    $user->update();
    $ctx->executeQuery();
    print "User has been updated'\r\n";
}

