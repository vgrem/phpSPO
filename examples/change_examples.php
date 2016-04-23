<?php


require_once(__DIR__ . '/../src/ClientContext.php');
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
    getListItemChanges($list);
    //getWebChanges($ctx->getWeb());
}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}

function getListItemChanges(\SharePoint\PHP\Client\SPList $list)
{
    $ctx = $list->getContext();

    $query = new ChangeLogItemQuery();
    $query->ChangeToken = "1;3;e49a3225-13f6-47d4-a146-30d9caa05362;635969955256400000;10637059";
    $items = $list->getListItemChangesSinceToken($query);
    $ctx->executeQuery();
    foreach ($items->getData() as $item) {
        print "[List Item] $item->Title\r\n";
    }
}

function getListChanges(\SharePoint\PHP\Client\SPList $list)
{
    $ctx = $list->getContext();

    $query = new ChangeQuery();
    $query->Add = true;
    $query->Update = true;
    $query->DeleteObject = true;
    $query->Item = true;
    $query->File = true;

    $changes = $list->getChanges($query);
    $ctx->executeQuery();

    foreach ($changes->getData() as $change) {
        $changeTypeName = ChangeType::parse($change->ChangeType);
        print "Change ( {$change->Time} , {$changeTypeName} , {$change->ChangeToken->StringValue} )\r\n";
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

    foreach ($changes->getData() as $change) {
        $changeTypeName = ChangeType::parse($change->ChangeType);
        print "Change ( {$change->Time} , {$changeTypeName} , {$change->ChangeToken->StringValue} )\r\n";
    }
}