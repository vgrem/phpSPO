<?php



require_once(__DIR__ . '/../src/runtime/auth/NtlmAuthenticationContext.php');
require_once 'Settings.php';


use SharePoint\PHP\Client\NtlmAuthenticationContext;

try {
	/* @var $authCtx NtlmAuthenticationContext */
	$authCtx = new NtlmAuthenticationContext($Settings['Url'], $Settings['UserName'], $Settings['Password']);
	echo 'You have been authenticated successfully\n';
}
catch (Exception $e) {
	echo 'Authentication failed: ',  $e->getMessage(), "\n";
}


?>
