<?php


use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;

require_once '../bootstrap.php';
$settings = include('../../Settings.php');

try {
	$authCtx = new AuthenticationContext($settings['Url']);
	$authCtx->acquireTokenForUser($settings['UserName'],$settings['Password']);
	echo 'Authentication succeeded';
}
catch (Exception $e) {
	echo 'Authentication failed: ',  $e->getMessage(), "\n";
}
