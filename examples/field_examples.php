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

    getListFields($ctx);
}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}


function getListFields(ClientContext $ctx){

    $listTitle = 'Tasks';

    $web = $ctx->getWeb();
    $list = $web->getLists()->getByTitle($listTitle);
    $fields = $list->getFields();
    $ctx->load($fields);
    $ctx->executeQuery();
    foreach( $fields->getData() as $field ) {
        print "Field title: '{$field->Title}'\r\n";
    }
}
