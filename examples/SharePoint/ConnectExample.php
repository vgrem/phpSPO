<?php


use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;

require_once '../bootstrap.php';
global $Settings;

try {
	$authCtx = new AuthenticationContext($Settings['Url']);
	$authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
	echo 'Authentication succeeded';
}
catch (Exception $e) {
	echo 'Authentication failed: ',  $e->getMessage(), "\n";
}





?>
