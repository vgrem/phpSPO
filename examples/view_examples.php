<?php

require_once(__DIR__ . '/../src/ClientContext.php');
require_once(__DIR__ . '/../src/runtime/auth/AuthenticationContext.php');
require_once 'Settings.php';

use SharePoint\PHP\Client\AuthenticationContext;
use SharePoint\PHP\Client\ClientContext;


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



function printListViews(ClientContext $ctx,$listTitle){
    $list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
    $views = $list->getViews();
    $ctx->load($views);
    $ctx->executeQuery();
    foreach( $views->getData() as $view ) {
        print "View title: '{$view->Title}'\r\n";
    }
}




?>