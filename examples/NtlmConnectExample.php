<?php

require_once(__DIR__ . '/../src/runtime/auth/NetworkCredentialContext.php');
require_once(__DIR__ . '/../src/ClientContext.php');
require_once 'Settings.php';
global $Settings;


try {
	$authCtx = new \SharePoint\PHP\Client\NetworkCredentialContext($Settings['UserName'], $Settings['Password']);
	$authCtx->AuthType = CURLAUTH_NTLM; //NTML auth schema
	$ctx = new \SharePoint\PHP\Client\ClientContext($Settings['Url'],$authCtx);
	$site = $ctx->getSite();
	$ctx->load($site); //load site settings
	$ctx->executeQuery();
	print $site->getProperty("Url");
}
catch (Exception $e) {
	print 'Authentication failed: ' .  $e->getMessage(). "\n";
}



?>
