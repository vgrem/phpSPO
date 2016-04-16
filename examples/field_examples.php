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

    //getWebFields($ctx);
    //getListFields($ctx);
    getListFieldByTitle($ctx);
    //getListFieldByInternalName($ctx);
}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}



function getWebFields(ClientContext $ctx){

    $web = $ctx->getWeb();
    $fields = $web->getFields();
    $ctx->load($fields);
    $ctx->executeQuery();
    foreach( $fields->getData() as $field ) {
        print "Field title: '{$field->Title}'\r\n";
    }
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


function getListFieldByTitle(ClientContext $ctx){

    $listTitle = 'Tasks';
    $fieldTitle = "Title";

    $web = $ctx->getWeb();
    $list = $web->getLists()->getByTitle($listTitle);
    $field = $list->getFields()->getByTitle($fieldTitle);
    $ctx->load($field);
    $ctx->executeQuery();
    print "Field: '{$field->Title}'\r\n";

    
    $field->setShowInDisplayForm(true);
    $ctx->executeQuery();
}


function getListFieldByInternalName(ClientContext $ctx){

    $listTitle = 'Tasks';
    $fieldName = "FileRef";

    $web = $ctx->getWeb();
    $list = $web->getLists()->getByTitle($listTitle);
    $field = $list->getFields()->getByInternalNameOrTitle($fieldName);
    $ctx->load($field);
    $ctx->executeQuery();
    print "Field: '{$field->Title}'\r\n";
}
