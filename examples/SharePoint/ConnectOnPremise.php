<?php
$Settings = include('../../settings.php');

use Office365\Runtime\Auth\UserCredentials;
use Office365\SharePoint\ClientContext;

$userCreds = new UserCredentials($Settings['username'], $Settings['password']);
$ctx = (new ClientContext($Settings['url']))->withNtlm($userCreds);
$me = $ctx->getWeb()->getCurrentUser()->get()->executeQuery();