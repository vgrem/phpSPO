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
	//readWeb($ctx);
    $web = createWeb($ctx);
	updateWeb($web);
    deleteWeb($web);
}
catch (Exception $e) {
	echo 'Error: ',  $e->getMessage(), "\n";
}


function readWeb(ClientContext $ctx){
	#read web properties
	$web = $ctx->getWeb();
    $ctx->load($web);
	$ctx->executeQuery();
	print "Web title: '{$web->Title}'\r\n";

	#2. Read user custom actions
	$customActions = $web->getUserCustomActions();
	$ctx->load($customActions);
	$ctx->executeQuery();
	foreach( $customActions->getData() as $customAction ) {
		print "User custom action: '{$customAction->Title}'\r\n";
	}


    /*$roleAssignments = $web->getRoleAssignments();
    $ctx->load($roleAssignments);
    $ctx->executeQuery();
    foreach( $roleAssignments->getData() as $roleAssignment ) {
        print "Field title: '{$roleAssignment->Member}'\r\n";
    }*/
}

function createWeb(ClientContext $ctx)
{
	$web = $ctx->getWeb();
	$webUrl = "Workspace_" . rand(1, 1000);
	
	$info = new \SharePoint\PHP\Client\WebCreationInformation();
	$info->Title = "Workspace";
	$info->Description = "Workspace web site";
	$info->Url = $webUrl;
	$info->WebTemplate = "STS";
	$info->UseUniquePermissions = false;

	$web = $web->getWebs()->add($info);
	$ctx->executeQuery();
	print "Web site {$web->Url} has been created'\r\n";
	return $web;
}



function updateWeb(\SharePoint\PHP\Client\Web $web)
{
	$ctx = $web->getContext();
	$info = array(
		Title => "Workspace_" . date("Y-m-d")
	);
	$web = $web->update($info);
	$ctx->executeQuery();
	print "Web site {$web->Url} has been updated'\r\n";
	return $web;
}


/**
 * Delete web operation example
 */
function deleteWeb(SharePoint\PHP\Client\Web $web){
	$ctx = $web->getContext();
	$web->deleteObject();
	$ctx->executeQuery();
	print "Web site '{$web->Url}' has been deleted.\r\n";
}

?>
