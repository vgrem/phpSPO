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
	readWeb($ctx);
    //createWeb($ctx);
	//updateWeb($ctx);
    //deleteWeb($ctx);
}
catch (Exception $e) {
	echo 'Error: ',  $e->getMessage(), "\n";
}


function readWeb(ClientContext $ctx){
	$web = $ctx->getWeb();
    $ctx->load($web);
    $ctx->executeQuery();
	print "Web title: '{$web->Title}'\r\n";


    /*$roleAssignments = $web->getRoleAssignments();
    $ctx->load($roleAssignments);
    $ctx->executeQuery();
    foreach( $roleAssignments->getData() as $roleAssignment ) {
        print "Field title: '{$roleAssignment->Member}'\r\n";
    }*/
}

function createWeb(ClientContext $ctx){
	$web = $ctx->getWeb();
    $info = array( 'parameters' => array( '__metadata' => array( 'type' => 'SP.WebCreationInformation' ),
                   'Title' => 'Team projects', 'Url' => 'TeamProjects', 'WebTemplate' => 'STS', 'UseSamePermissionsAsParentSite' => true ) 
                   );
    $web= $web->getWebs()->add($info);
    $ctx->executeQuery();
	print "Web site {$web->Title} created'\r\n";
}

?>


