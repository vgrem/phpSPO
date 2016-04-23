<?php


require_once(__DIR__.'/../src/ClientContext.php');
require_once(__DIR__.'/../src/auth/AuthenticationContext.php');
require_once 'Settings.php';

use SharePoint\PHP\Client\AuthenticationContext;
use SharePoint\PHP\Client\ChangeLogItemQuery;
use SharePoint\PHP\Client\ChangeQuery;
use SharePoint\PHP\Client\ChangeType;
use SharePoint\PHP\Client\ClientContext;
use SharePoint\PHP\Client\ListCreationInformation;


try {
    $authCtx = new AuthenticationContext($Settings['Url']);
    $authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
    $ctx = new ClientContext($Settings['Url'],$authCtx);
    
    $listTitle = "Tasks" ;
    $list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
    getListChanges($list);
    //getWebChanges($ctx->getWeb());
}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}

function getListChanges(\SharePoint\PHP\Client\SPList $list){
    $ctx = $list->getContext();
    $query = new ChangeQuery();
    $query->Add = true;
    $query->Update = true;
    $query->DeleteObject = true;
    $query->Item = true;
    $query->File = true;

    $changes = $list->getChanges($query);
    $ctx->executeQuery();


    foreach( $changes->getData() as $change ) {
        $changeTypeName = ChangeType::toString($change->ChangeType);
        print "Change type : $change->Time : $changeTypeName\r\n";
    }

}


function getWebChanges(\SharePoint\PHP\Client\Web $web){
    $ctx = $web->getContext();
    $query = new ChangeQuery();
    $query->Add = true;
    $query->Update = true;
    $query->DeleteObject = true;
    $query->Web = true;
    $changes = $web->getChanges($query);
    $ctx->executeQuery();
    print $changes;
}