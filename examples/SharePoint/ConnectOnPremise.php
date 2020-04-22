<?php
$Settings = include('../../settings.php');
use Office365\Runtime\Auth\NetworkCredentialContext;
use Office365\SharePoint\ClientContext;

$authCtx = new NetworkCredentialContext($Settings['username'], $Settings['password']);
$authCtx->AuthType = CURLAUTH_NTLM;
$ctx = new ClientContext($Settings['url'],$authCtx);
$ctx->executeQuery();