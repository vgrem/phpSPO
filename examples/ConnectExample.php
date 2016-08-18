<?php



require_once(__DIR__ . '/../src/Runtime/Auth/AuthenticationContext.php');
require_once 'Settings.php';
use SharePoint\PHP\Client\AuthenticationContext;
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
