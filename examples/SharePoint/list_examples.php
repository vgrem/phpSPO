<?php


require_once('../bootstrap.php');

use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\SharePoint\ClientContext;
use Office365\PHP\Client\SharePoint\ListCreationInformation;
use Office365\PHP\Client\SharePoint\SPList;

global $Settings;
try {
	$authCtx = new AuthenticationContext($Settings['Url']);
	$authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
    $ctx = new ClientContext($Settings['Url'],$authCtx);


    $listTitle = 'Archive 2017';
    //$listTitle = 'Archive%202017';
    $list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
    $ctx->load($list);
    $ctx->executeQuery();

    echo  $list->getProperty('Title');

	$listTitle = "Orders_" . rand(1,1000);
	//$listTitle = "Tasks" ;

	printLists($ctx);
    //$list = ensureList($ctx,$listTitle);
	//updateList($list);
	//assignUniquePermissions($list);
	//printPermissions($list,$Settings['UserName']);
    //deleteList($list);
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



function printPermissions(SPList $list, $loginName){
	$ctx = $list->getContext();
	$permissions = $list->getUserEffectivePermissions($loginName);
	$ctx->executeQuery();
	var_dump($permissions);
}


function assignUniquePermissions(SPList $list){
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
 * @return \Office365\PHP\Client\SharePoint\SPList
 */
function createList(ClientContext $ctx, $listTitle){
	$info = new ListCreationInformation($listTitle);
	$info->Description = "Orders list";
	$info->BaseTemplate = \Office365\PHP\Client\SharePoint\ListTemplateType::Tasks;
	$list = $ctx->getWeb()->getLists()->add($info);
    $ctx->executeQuery();
	print "List '{$list->Title}' has been created.\r\n";
	return $list;
}


function ensureList(Office365\PHP\Client\SharePoint\ClientContext $ctx, $listTitle){

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
 * @param \Office365\PHP\Client\SharePoint\SPList $list
 */
function updateList(SPList $list){
	$ctx = $list->getContext();
	$list->setProperty('Title','New Orders');
	$list->update();
    $ctx->executeQuery();
    print "List {$list->getProperty('Title')} has been updated.\r\n";
}