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

    //getSiteGroups($ctx);
    //getGroup($ctx);
    removeGroup($ctx);

}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}



function getSiteGroups(ClientContext $ctx){

    $web = $ctx->getWeb();
    $groups = $web->getSiteGroups();
    $ctx->load($groups);
    $ctx->executeQuery();
    foreach( $groups->getData() as $group ) {
        print "Group title: '{$group->Title}'\r\n";
    }
}


function getGroup(ClientContext $ctx){

    $web = $ctx->getWeb();
    $group = $web->getSiteGroups()->getById(5);
    $ctx->load($group);
    $ctx->executeQuery();
    print "Group title: '{$group->Title}'\r\n";
}


function removeGroup(ClientContext $ctx){

    $web = $ctx->getWeb();
    $web->getSiteGroups()->removeById(19);
    $ctx->executeQuery();
    print "Group has been deleted\r\n";
}


