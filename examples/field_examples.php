<?php

use SharePoint\PHP\Client\AuthenticationContext;
use SharePoint\PHP\Client\ClientContext;


require_once(__DIR__ . '/../src/SharePoint/ClientContext.php');
require_once(__DIR__ . '/../src/Runtime/Auth/AuthenticationContext.php');
require_once 'Settings.php';

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



function listWebFields(\SharePoint\PHP\Client\Web $web){
    $ctx = $web->getContext();
    $fields = $web->getFields();
    $ctx->load($fields);
    $ctx->executeQuery();
    foreach( $fields->getData() as $field ) {
        print "Field title: '{$field->Title}'\r\n";
    }
    //print "Completed\r\n";
}


function listListFields(\SharePoint\PHP\Client\SPList $list){
    $ctx = $list->getContext();
    $fields = $list->getFields();
    $ctx->load($fields);
    $ctx->executeQuery();
    foreach( $fields->getData() as $field ) {
        print "Field title: '{$field->Title}'\r\n";
    }
}


function getListFieldByTitle(\SharePoint\PHP\Client\SPList $list, $fieldTitle){
    print "Getting field from list by title:\r\n";
    $ctx = $list->getContext();
    $field = $list->getFields()->getByTitle($fieldTitle);
    $ctx->load($field);
    $ctx->executeQuery();
    print "Field title: '{$field->Title}'\r\n";
    $field->setShowInDisplayForm(true);
    $ctx->executeQuery();
}


function getListFieldByInternalName(\SharePoint\PHP\Client\SPList $list, $fieldName){
    print "Getting field from list by internal name:\r\n";
    $ctx = $list->getContext();
    $field = $list->getFields()->getByInternalNameOrTitle($fieldName);
    $ctx->load($field);
    $ctx->executeQuery();
    print "Field title: '{$field->Title}'\r\n";
}
