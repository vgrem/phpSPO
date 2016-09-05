<?php


use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\SharePoint\ChangeLogItemQuery;
use Office365\PHP\Client\SharePoint\ChangeQuery;
use Office365\PHP\Client\SharePoint\ChangeType;
use Office365\PHP\Client\SharePoint\ClientContext;

require_once '../bootstrap.php';
global $Settings;

try {
    $authCtx = new AuthenticationContext($Settings['Url']);
    $authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
    $ctx = new ClientContext($Settings['Url'],$authCtx);
    
    $listTitle = "Tasks" ;
    $list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
    getListChanges($list);
    getListItemChanges($list);
    //getListItemChangesAlt($Settings['Url'],$authCtx);
    getWebChanges($ctx->getWeb());
}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}


function getListItemChangesAlt($webUrl, AuthenticationContext $authCtx)
{
    /*$listTitle = "Documents";
    $payload = [
        'query' => [
            '__metadata' => ['type' => 'SP.ChangeLogItemQuery'],
            'ViewName' => '',
            'QueryOptions'=> '<QueryOptions><Folder>Shared Documents</Folder></QueryOptions>'
        ]
    ];

    var $ctx = new ClientContext($webUrl,$authCtx);
    $url = $webUrl . "/_api/web/Lists/getbytitle('$listTitle')/GetListItemChangesSinceToken";
    $options = new \SharePoint\PHP\Client\RequestOptions($url);
    $options->Data = json_encode($payload);
    $options->PostMethod =  true;
    $response = ClientRequest::executeQueryDirect($ctx,$options);

    //process results
    $xml = simplexml_load_string($response);
    $xml->registerXPathNamespace('z', '#RowsetSchema');
    $rows = $xml->xpath("//z:row");
    foreach($rows as $row) {
        print (string)$row->attributes()["ows_FileLeafRef"] . "\n";
    }*/
}

function getListItemChanges(\Office365\PHP\Client\SharePoint\SPList $list)
{
    print "Getting list items changes...\n";
    $ctx = $list->getContext();
    $query = new ChangeLogItemQuery();
    //$query->ChangeToken = "1;3;e49a3225-13f6-47d4-a146-30d9caa05362;635969955256400000;10637059";
    $items = $list->getListItemChangesSinceToken($query);
    $ctx->executeQuery();
    foreach ($items->getData() as $item) {
        print "[List Item] $item->Title\r\n";
    }
}

function getListChanges(\Office365\PHP\Client\SharePoint\SPList $list)
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


function getWebChanges(\Office365\PHP\Client\SharePoint\Web $web){
    print "Getting web changes...\n";
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