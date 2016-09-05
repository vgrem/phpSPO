<?php


use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\SharePoint\ClientContext;

require_once '../bootstrap.php';

global $Settings;

try {
    $authCtx = new AuthenticationContext($Settings['Url']);
    $authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
    $ctx = new ClientContext($Settings['Url'],$authCtx);

    $listTitle = 'Tasks';
    $fieldTitle = "Title";
    $fieldName = "FileRef";

    $web = $ctx->getWeb();
    //listWebFields($web);
    $list = $web->getLists()->getByTitle($listTitle);
    listListFields($list);
    getListFieldByTitle($list,$fieldTitle);
    getListFieldByInternalName($list,$fieldName);
}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}



function listWebFields(\Office365\PHP\Client\SharePoint\Web $web){
    $ctx = $web->getContext();
    $fields = $web->getFields();
    $ctx->load($fields);
    $ctx->executeQuery();
    foreach( $fields->getData() as $field ) {
        print "Field title: '{$field->Title}'\r\n";
    }
    //print "Completed\r\n";
}


function listListFields(\Office365\PHP\Client\SharePoint\SPList $list){
    $ctx = $list->getContext();
    $fields = $list->getFields();
    $ctx->load($fields);
    $ctx->executeQuery();
    foreach( $fields->getData() as $field ) {
        print "Field title: '{$field->Title}'\r\n";
    }
}


function getListFieldByTitle(\Office365\PHP\Client\SharePoint\SPList $list, $fieldTitle){
    print "Getting field from list by title:\r\n";
    $ctx = $list->getContext();
    $field = $list->getFields()->getByTitle($fieldTitle);
    $ctx->load($field);
    $ctx->executeQuery();
    print "Field title: '{$field->Title}'\r\n";
    $field->setShowInDisplayForm(true);
    $ctx->executeQuery();
}


function getListFieldByInternalName(\Office365\PHP\Client\SharePoint\SPList $list, $fieldName){
    print "Getting field from list by internal name:\r\n";
    $ctx = $list->getContext();
    $field = $list->getFields()->getByInternalNameOrTitle($fieldName);
    $ctx->load($field);
    $ctx->executeQuery();
    print "Field title: '{$field->Title}'\r\n";
}
