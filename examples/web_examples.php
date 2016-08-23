<?php

require_once(__DIR__ . '/../src/SharePoint/ClientContext.php');
require_once(__DIR__ . '/../src/Runtime/Auth/AuthenticationContext.php');
require_once (__DIR__ . '/../src/Runtime/Soap/SoapClientRequest.php');
require_once 'Settings.php';

use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\SharePoint\ClientContext;
use Office365\PHP\Client\SharePoint\Web;
use Office365\PHP\Client\SharePoint\WebCreationInformation;

global $Settings;

try {
	$authCtx = new AuthenticationContext($Settings['Url']);
	$authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);

    $ctx = new ClientContext($Settings['Url'],$authCtx);
	$list = $ctx->getWeb()->getLists()->getByTitle("Pages");
	$ctx->load($list);
	$ctx->executeQuery();

	//$request = new SharePoint\PHP\Client\Runtime\Soap\ClientRequest();
	//$xml = $request->buildQuery();
	//print $xml;

    //create a workspace
	$webUrl = "Workspace_" . date("Y-m-d") . rand(1,100);
	$web = createWeb($ctx,$webUrl);
	//$web = $ctx->getWeb(); //findWeb($ctx,$webUrl);
	if(isset($web)){
		print "Web site: '{$web->getProperty('Title')} has been found'\r\n";
		updateWeb($web);
		readWebProperties($web);
		deleteWeb($web);
	}

}
catch (Exception $e) {
	echo 'Error: ',  $e->getMessage(), "\n";
}


function findWeb(ClientContext $ctx, $webUrl){
	print "Retrieving web site properties...\r\n";
	$webs = $ctx->getWeb()->getWebs();
    $ctx->load($webs);
	$ctx->executeQuery();
	foreach( $webs->getData() as $web ) {
		if($web->Url == $webUrl){
			return $web;
		}
	}
	return null;
}


function readWebProperties(\Office365\PHP\Client\SharePoint\Web $web)
{

	//$ctx = $web->getContext();
	

	/*#2. Read user custom actions
	$customActions = $web->getUserCustomActions();
	$ctx->load($customActions);
	$ctx->executeQuery();
	foreach( $customActions->getData() as $customAction ) {
		print "User custom action: '{$customAction->Title}'\r\n";
	}*/


	/*$roleAssignments = $web->getRoleAssignments();
    $ctx->load($roleAssignments);
    $ctx->executeQuery();
    foreach( $roleAssignments->getData() as $roleAssignment ) {
        print "Field title: '{$roleAssignment->Member}'\r\n";
    }*/

}

/**
 * @param ClientContext $ctx
 * @param $webUrl
 * @return Web
 */
function createWeb(ClientContext $ctx, $webUrl)
{
	print "Creating web site...\r\n";
	$web = $ctx->getWeb();
	$info = new WebCreationInformation($webUrl,"Workspace");
	$info->WebTemplate = "STS";
	$info->UseSamePermissionsAsParentSite = false;

	$web = $web->getWebs()->add($info);
	$ctx->executeQuery();
	print "Web site " . $web->getProperty("Url") . " has been created\r\n";
	return $web;
}



function updateWeb(\Office365\PHP\Client\SharePoint\Web $web)
{
	print "Updating web site...\r\n";
	$ctx = $web->getContext();
	$web->setProperty("Title","Workspace_" . date("Y-m-d"));
	$web->update();
	$ctx->executeQuery();
	print "Web site has been updated.\r\n";
	return $web;
}


/**
 * Delete web operation example
 * @param \Office365\PHP\Client\SharePoint\Web $web
 */
function deleteWeb(Office365\PHP\Client\SharePoint\Web $web){
	print "Deleting web site...\r\n";
	$ctx = $web->getContext();
	$web->deleteObject();
	$ctx->executeQuery();
	print "Web site '{$web->getProperty('Url')}' has been deleted.\r\n";
}
