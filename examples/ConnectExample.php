<?php



require_once(__DIR__ . '/../src/runtime/auth/AuthenticationContext.php');
require_once 'Settings.php';


use SharePoint\PHP\Client\AuthenticationContext;


connectUsingSamlToken($Settings['Url'],$Settings['UserName'],$Settings['Password']);


function connectUsingSamlToken($webUrl,$userName,$password){

	try {
		$authCtx = new AuthenticationContext($webUrl);
		$authCtx->acquireTokenForUser($userName,$password);
		echo 'Authentication succeeded';
	}
	catch (Exception $e) {
		echo 'Authentication failed: ',  $e->getMessage(), "\n";
	}
}




?>
