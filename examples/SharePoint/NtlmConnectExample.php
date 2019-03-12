<?php

use Office365\PHP\Client\Runtime\Auth\NetworkCredentialContext;
use Office365\PHP\Client\SharePoint\ClientContext;


require_once('../bootstrap.php');
$Settings = include('../../Settings.php');

try {
	$authCtx = new NetworkCredentialContext($Settings['UserName'], $Settings['Password']);
	$authCtx->AuthType = CURLAUTH_NTLM; //NTML Auth schema
	$ctx = new ClientContext($Settings['Url'],$authCtx);
	$site = $ctx->getSite();
	$ctx->load($site); //load site settings
	$ctx->executeQuery();
	print $site->getProperty("Url");
}
catch (Exception $e) {
	print 'Authentication failed: ' .  $e->getMessage(). "\n";
}
