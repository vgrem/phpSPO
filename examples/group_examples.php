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

    getSiteGroups($ctx);
    $group = createGroup($ctx);
    //getGroup($ctx,$group->Id);
    removeGroup($group);
    

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


function createGroup(ClientContext $ctx){

    $web = $ctx->getWeb();
    $info = new \SharePoint\PHP\Client\GroupCreationInformation();
    $info->Title = "Approver" . rand(1,1000);
    $group = $web->getSiteGroups()->add($info);
    $ctx->executeQuery();
    print "Group : '{$group->Title}' has been created\r\n";
    return $group;
}


function getGroup(ClientContext $ctx,$groupId){

    $web = $ctx->getWeb();
    $group = $web->getSiteGroups()->getById($groupId);
    $ctx->load($group);
    $ctx->executeQuery();
    print "Group title: '{$group->Title}'\r\n";
}


function removeGroup(\SharePoint\PHP\Client\Group $group){

    $ctx = $group->getContext();
    $ctx->getWeb()->getSiteGroups()->removeById($group->Id);
    $ctx->executeQuery();
    print "Group '{$group->Title}' has been deleted\r\n";
}


