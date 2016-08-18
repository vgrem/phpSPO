<?php

use SharePoint\PHP\Client\ClientContext;
use SharePoint\PHP\Client\NetworkCredentialContext;

require_once(__DIR__ . '/../src/Runtime/Auth/NetworkCredentialContext.php');
require_once(__DIR__ . '/../src/SharePoint/ClientContext.php');
require_once 'Settings.php';
global $Settings;

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
