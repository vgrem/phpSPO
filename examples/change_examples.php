<?php


require_once(__DIR__ . '/../src/ClientContext.php');
require_once(__DIR__.'/../src/auth/AuthenticationContext.php');
require_once 'Settings.php';

use SharePoint\PHP\Client\AuthenticationContext;
use SharePoint\PHP\Client\ChangeLogItemQuery;
use SharePoint\PHP\Client\ChangeQuery;
use SharePoint\PHP\Client\ChangeType;
use SharePoint\PHP\Client\ClientContext;
use SharePoint\PHP\Client\ClientRequest;
use SharePoint\PHP\Client\ListCreationInformation;



try {
    $authCtx = new AuthenticationContext($Settings['Url']);
    $authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
    $ctx = new ClientContext($Settings['Url'],$authCtx);
    
    $listTitle = "Tasks" ;
    $list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
    getListChanges($list);
    getListItemChanges($list);
    //getListItemChangesAlt($Settings['Url'],$authCtx);
    //getWebChanges($ctx->getWeb());
}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}


function getListItemChangesAlt($webUrl, AuthenticationContext $authCtx)
{
    $listTitle = "Documents";
    $payload = array(
        'query' => array(
            '__metadata' => array('type' => 'SP.ChangeLogItemQuery'),
            'ViewName' => '',
            'QueryOptions'=> '<QueryOptions><Folder>Shared Documents</Folder></QueryOptions>'
        )
    );

    $request = new ClientRequest($webUrl,$authCtx);
    $options = array(
        'url' => $webUrl . "/_api/web/Lists/GetByTitle('$listTitle')/GetListItemChangesSinceToken",
        'data' => json_encode($payload),
        'method' => 'POST'
    );
    $response = $request->executeQueryDirect($options);

    //process results
    $xml = simplexml_load_string($response);
    $xml->registerXPathNamespace('z', '#RowsetSchema');
    $rows = $xml->xpath("//z:row");
    foreach($rows as $row) {
        print (string)$row->attributes()["ows_FileLeafRef"] . "\n";
    }

}

function getListItemChanges(\SharePoint\PHP\Client\SPList $list)
{
    $ctx = $list->getContext();

    $query = new ChangeLogItemQuery();
    //$query->ChangeToken = "1;3;e49a3225-13f6-47d4-a146-30d9caa05362;635969955256400000;10637059";
    $items = $list->getListItemChangesSinceToken($query);
    $ctx->executeQuery();
    foreach ($items->getData() as $item) {
        print "[List Item] $item->Title\r\n";
    }
}

function getListChanges(\SharePoint\PHP\Client\SPList $list)
{
    print "Getting list changes...\n";
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
        $changeTypeName = ChangeType::getName($change->ChangeType);
        $changeName = basename(get_class($change));
        print "{$changeName} ( {$change->Time} , {$changeTypeName} , {$change->ChangeToken->StringValue} )\r\n";
    }
}


function getWebChanges(\SharePoint\PHP\Client\Web $web){
    $ctx = $web->getContext();
    $query = new ChangeQuery();
    $query->Add = true;
    $query->Update = true;
    $query->DeleteObject = true;
    $query->Web = true;
    $query->List = true;
    $changes = $web->getChanges($query);
    $ctx->executeQuery();

    foreach ($changes->getData() as $change) {
        $changeTypeName = ChangeType::getName($change->ChangeType);
        print "Change ( {$change->Time} , {$changeTypeName} , {$change->ChangeToken->StringValue} )\r\n";
    }
}