<?php


use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\SharePoint\ClientContext;
use Office365\PHP\Client\SharePoint\Group;

require_once('../bootstrap.php');
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
    $info = new \Office365\PHP\Client\SharePoint\GroupCreationInformation($groupTitle);
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


