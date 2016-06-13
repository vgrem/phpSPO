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


function findWeb(ClientContext $ctx,$webUrl){
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


function readWebProperties(\SharePoint\PHP\Client\Web $web)
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

function createWeb(ClientContext $ctx,$webUrl)
{
	print "Creating web site...\r\n";
	$web = $ctx->getWeb();
	$info = new \SharePoint\PHP\Client\WebCreationInformation($webUrl,"Workspace");
	$info->WebTemplate = "STS";
	$info->UseSamePermissionsAsParentSite = false;

	$web = $web->getWebs()->add($info);
	$ctx->executeQuery();
	print "Web site {$web->getProperty('Url')} has been created\r\n";
	return $web;
}



function updateWeb(\SharePoint\PHP\Client\Web $web)
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
 * @param \SharePoint\PHP\Client\Web $web
 */
function deleteWeb(SharePoint\PHP\Client\Web $web){
	print "Deleting web site...\r\n";
	$ctx = $web->getContext();
	$web->deleteObject();
	$ctx->executeQuery();
	print "Web site '{$web->getProperty('Url')}' has been deleted.\r\n";
}

?>
