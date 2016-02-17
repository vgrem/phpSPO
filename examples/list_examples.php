<?php

require_once(__DIR__.'/../src/ClientContext.php');
require_once(__DIR__.'/../src/auth/AuthenticationContext.php');
require_once 'Settings.php';

use SharePoint\PHP\Client\AuthenticationContext;
use SharePoint\PHP\Client\ClientContext;


try {
	$authCtx = new AuthenticationContext($Settings['Url']);
	$authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);

    $ctx = new ClientContext($Settings['Url'],$authCtx);
	//printLists($ctx);
    //createList($ctx);
	//updateList($ctx);
    deleteList($ctx);
}
catch (Exception $e) {
	echo 'Error: ',  $e->getMessage(), "\n";
}



/**
 * Read list collection in web site
 */
function printLists(ClientContext $ctx){
    $lists = $ctx->getWeb()->getLists();
    $ctx->load($lists);
    $ctx->executeQuery();
	foreach( $lists->getData() as $list ) {
	    print "Task: '{$list->Title}'\r\n";
	}
}

/**
 * Create list item operation example 
 */
function createList(ClientContext $ctx){
    $listProperties = array( '__metadata' => array( 'type' => 'SP.List' ), 'AllowContentTypes' => true, 'BaseTemplate'=>  100,
    'ContentTypesEnabled' => true, 'Description' =>  'My list description', 'Title' => 'Test title' );
	$list = $ctx->getWeb()->getLists()->add($listProperties);
    $ctx->executeQuery();
	print "List '{$list->Title}' has been created.\r\n";
}

/**
 * Delete list operation example
 */
function deleteList(ClientContext $ctx){
	
	$listTitle = 'Test title';
	$list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
	$list->deleteObject();
    $ctx->executeQuery();
    print "List has been deleted.\r\n";
}

/**
 * Update list operation example
 */
function updateList(ClientContext $ctx){
	$listTitle = 'Test title';
	$list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
	$listProperties = array( '__metadata' => array( 'type' => 'SP.List' ), 'AllowContentTypes' => true, 'BaseTemplate'=>  100,
    'ContentTypesEnabled' => true, 'Title' => 'new Title');
	$list->update($listProperties);
    $ctx->executeQuery();
    print "List has been updated.\r\n";
}



?>