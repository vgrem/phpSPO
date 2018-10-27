<?php

require_once('../bootstrap.php');

use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\ClientAction;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use Office365\PHP\Client\SharePoint\ClientContext;

global $Settings;

try {

    $authCtx = new AuthenticationContext($Settings['Url']);
    $authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
    $ctx = new ClientContext($Settings['Url'],$authCtx);
    //$listTitle = "Orders_" . rand(1,1000);
    $listTitle = "Tasks" ;
    printListViews($ctx,$listTitle);
}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}


function printListViews(ClientContext $ctx, $listTitle){
    $list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
    $views = $list->getViews();
    $ctx->load($views);
    $ctx->executeQuery();
    foreach( $views->getData() as $view ) {
        print "View title: '{$view->Title}'\r\n";
    }
}