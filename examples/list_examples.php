<?php

require_once(__DIR__ . '/../src/SharePoint/ClientContext.php');
require_once(__DIR__ . '/../src/Runtime/Auth/AuthenticationContext.php');
require_once 'Settings.php';

use SharePoint\PHP\Client\AuthenticationContext;
use SharePoint\PHP\Client\ClientContext;
use SharePoint\PHP\Client\ListCreationInformation;
use SharePoint\PHP\Client\SPList;

global $Settings;
try {
	$authCtx = new AuthenticationContext($Settings['Url']);
	$authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
    $ctx = new ClientContext($Settings['Url'],$authCtx);


	$listTitle = "Orders_" . rand(1,1000);
	//$listTitle = "Tasks" ;

	//printLists($ctx);
    $list = ensureList($ctx,$listTitle);
	updateList($list);
	//assignUniquePermissions($list);
	//printPermissions($list,$Settings['UserName']);
    deleteList($list);
	//printListDetails($ctx,$listTitle);
}
catch (Exception $e) {
	echo 'Error: ',  $e->getMessage(), "\n";
}


function printListDetails(ClientContext $ctx, $listTitle){
	$list = $lists = $ctx->getWeb()->getLists()->getByTitle($listTitle);
	$irmSettings = $list->getInformationRightsManagementSettings();
	$ctx->load($irmSettings);
	$ctx->executeQuery();

	print $irmSettings;
}



function printPermissions(SharePoint\PHP\Client\SPList $list,$loginName){
	$ctx = $list->getContext();
	$permissions = $list->getUserEffectivePermissions($loginName);
	$ctx->executeQuery();
}


function assignUniquePermissions(SharePoint\PHP\Client\SPList $list){
	$ctx = $list->getContext();
	$list->breakRoleInheritance(true);
	$ctx->executeQuery();
	print "List " . $list->getProperty('Title') . " has been assigned a unique permissions.\r\n";
}


/**
 * Read list collection in web site
 * @param ClientContext $ctx
 */
function printLists(ClientContext $ctx){
    $lists = $ctx->getWeb()->getLists();
    $ctx->load($lists);
    $ctx->executeQuery();
	foreach( $lists->getData() as $list ) {
	    print "List title: '{$list->Title}'\r\n";
	}
}

/**
 * Create list item operation example
 * @param ClientContext $ctx
 * @param $listTitle
 * @return \SharePoint\PHP\Client\SPList
 */
function createList(ClientContext $ctx, $listTitle){
	$info = new ListCreationInformation($listTitle);
	$info->Description = "Orders list";
	$info->BaseTemplate = \SharePoint\PHP\Client\ListTemplateType::Tasks;
	$list = $ctx->getWeb()->getLists()->add($info);
    $ctx->executeQuery();
	print "List '{$list->Title}' has been created.\r\n";
	return $list;
}


function ensureList(SharePoint\PHP\Client\ClientContext $ctx, $listTitle){

	$list = null;
	$lists = $ctx->getWeb()->getLists();
	$ctx->load($lists);
	$ctx->executeQuery();
	foreach($lists->getData() as $curList) {
		if ($listTitle == $curList->Title) {
			print "List {$curList->Title} has been found\r\n";
			return $curList;
		}
	}
	return createList($ctx,$listTitle);
}

/**
 * Delete list operation example
 * @param SPList $list
 */
function deleteList(SPList $list){
	$ctx = $list->getContext();
	$list->deleteObject();
    $ctx->executeQuery();
    print "List " . $list->getProperty("Title") . " has been deleted.\r\n";
}

/**
 * Update list operation example
 * @param \SharePoint\PHP\Client\SPList $list
 */
function updateList(SPList $list){
	$ctx = $list->getContext();
	$list->setProperty('Title','New Orders');
	$list->update();
    $ctx->executeQuery();
    print "List {$list->getProperty('Title')} has been updated.\r\n";
}