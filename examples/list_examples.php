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


	//$listTitle = 'Documents';

	//printLists($ctx);
    $list = createList($ctx);
	updateList($list);
	//assignUniquePermissions($list);
	//printPermissions($list,$Settings['UserName']);
    deleteList($list);
}
catch (Exception $e) {
	echo 'Error: ',  $e->getMessage(), "\n";
}



function printPermissions(SharePoint\PHP\Client\SPList $list,$loginName){
	$ctx = $list->getContext();
	$permissions = $list->getUserEffectivePermissions($loginName);
	$ctx->executeQuery();

}


function assignUniquePermissions(SharePoint\PHP\Client\SPList $list){
	$ctx = $list->getContext();
	$list->breakRoleInheritance(true,true);
	$ctx->executeQuery();
	print "List '{$list->Title}' has been assigned a unique permissions.\r\n";
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
	$listTitle = "Orders_" . rand(1,1000);
    $listProperties = array(
		'AllowContentTypes' => true,
		'BaseTemplate'=>  100,
		'ContentTypesEnabled' => true,
		'Description' =>  'My list description',
		'Title' => $listTitle
	);
	$list = $ctx->getWeb()->getLists()->add($listProperties);
    $ctx->executeQuery();
	print "List '{$list->Title}' has been created.\r\n";
	return $list;
}

/**
 * Delete list operation example
 */
function deleteList(SharePoint\PHP\Client\SPList $list){
	$ctx = $list->getContext();
	$list->deleteObject();
    $ctx->executeQuery();
    print "List '{$list->Title}' has been deleted.\r\n";
}

/**
 * Update list operation example
 */
function updateList(SharePoint\PHP\Client\SPList $list){
	$ctx = $list->getContext();
	$listProperties = array(
		'AllowContentTypes' => true,
		'BaseTemplate'=>  100,
		'ContentTypesEnabled' => true,
		'Title' => 'New Orders'
	);
	$list->update($listProperties);
    $ctx->executeQuery();
    print "List '{$list->Title}' has been updated.\r\n";
}



?>