<?php

use SharePoint\PHP\Client\AuthenticationContext;
use SharePoint\PHP\Client\ClientContext;
use SharePoint\PHP\Client\Group;

require_once(__DIR__ . '/../src/SharePoint/ClientContext.php');
require_once(__DIR__ . '/../src/Runtime/Auth/AuthenticationContext.php');
require_once 'Settings.php';


global $Settings;
try {
    $authCtx = new AuthenticationContext($Settings['Url']);
    $authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
    $ctx = new ClientContext($Settings['Url'],$authCtx);
    getSiteGroups($ctx);
    $group = createGroup($ctx);
    getGroup($ctx,$group->Id);
    removeGroup($group);
    

}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}



function getSiteGroups(ClientContext $ctx){
    $groups = $ctx->getWeb()->getSiteGroups();
    $ctx->load($groups);
    $ctx->executeQuery();
    foreach( $groups->getData() as $group ) {
        print "Group title: '{$group->Title}'\r\n";
    }
}


function createGroup(ClientContext $ctx){

    $web = $ctx->getWeb();
    $groupTitle = "Approver" . rand(1,1000);
    $info = new \SharePoint\PHP\Client\GroupCreationInformation($groupTitle);
    $group = $web->getSiteGroups()->add($info);
    $ctx->executeQuery();
    print "Group : '{$group->Title}' has been created\r\n";
    return $group;
}


function getGroup(ClientContext $ctx, $groupId){

    $web = $ctx->getWeb();
    $group = $web->getSiteGroups()->getById($groupId);
    $ctx->load($group);
    $ctx->executeQuery();
    print "Group title: '{$group->Title}'\r\n";
}


function removeGroup(Group $group){

    $ctx = $group->getContext();
    $ctx->getWeb()->getSiteGroups()->removeById($group->Id);
    $ctx->executeQuery();
    print "Group " . $group->getProperty("Title") . " has been deleted\r\n";
}


