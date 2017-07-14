<?php

require_once('../bootstrap.php');

use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use Office365\PHP\Client\SharePoint\ClientContext;

global $Settings;


$requestData = file_get_contents("webrequest.xml");
$authCtx = new AuthenticationContext($Settings['Url']);
$authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
$ctx = new ClientContext($Settings['Url'],$authCtx);

$taxSession = new \Office365\PHP\Client\SharePoint\Taxonomy\TaxonomySession($ctx);
$ctx->load($taxSession);
$ctx->executeQuery();


/*$svcUrl = $Settings['Url'] . "/_vti_bin/client.svc/ProcessQuery";
$options = new RequestOptions($svcUrl);
$options->Data = $requestData;
$options->Method = \Office365\PHP\Client\Runtime\HttpMethod::Post;
$options->Headers = array(
   'content-type' => 'application/atom+xml',
   'Accept' => 'application/atom+xml'
);
$ctx->ensureFormDigest($options);
$response = $ctx->executeQueryDirect($options);
$json = json_decode($response);*/
