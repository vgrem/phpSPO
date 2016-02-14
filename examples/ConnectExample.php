<?php



require_once(__DIR__.'/../src/auth/AuthenticationContext.php');
require_once 'Settings.php';


use SharePoint\PHP\Client\AuthenticationContext;

try {
	$authCtx = new AuthenticationContext($Settings['Url']);
	$authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
	echo 'You have been authenticated successfully\n';
}
catch (Exception $e) {
	echo 'Authentication failed: ',  $e->getMessage(), "\n";
}


?>
