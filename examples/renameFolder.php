<?php

require_once(__DIR__ . '/../src/runtime/ClientRequest.php');
require_once(__DIR__ . '/../src/runtime/auth/AuthenticationContext.php');
require_once 'Settings.php';

use SharePoint\PHP\Client\AuthenticationContext;
use SharePoint\PHP\Client\ClientRequest;


global $Settings;

try {
	$authCtx = new AuthenticationContext($Settings['Url']);
	$authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);

    $folderUrl = "/sites/news/Documents/Archive";
    $folderNewName = "Archive2014";
    renameFolder($Settings['Url'],$authCtx,$folderUrl,$folderNewName);
    
}
catch (Exception $e) {
	echo 'Error: ',  $e->getMessage(), "\n";
}


function renameFolder($webUrl, $authCtx, $folderUrl,$folderNewName)
{
    $url = $webUrl . "/_api/web/getFolderByServerRelativeUrl('{$folderUrl}')/ListItemAllFields";
    $request = new \SharePoint\PHP\Client\RequestOptions($url);
    $ctx = new \SharePoint\PHP\Client\ClientRuntimeContext($url,$authCtx);
    $data = $ctx->executeQueryDirect($request);

    $itemPayload = array( 
        '__metadata' => array ('type' => $data->d->__metadata->type),
        'Title' => $folderNewName,
        'FileLeafRef' => $folderNewName
        );

    $itemUrl = $data->d->__metadata->uri;
    $request = new \SharePoint\PHP\Client\RequestOptions($itemUrl);
    $request->addCustomHeader("X-HTTP-Method", "MERGE");
    $request->addCustomHeader("If-Match", "*");
    $request->Data = $itemPayload;
    $data = $ctx->executeQueryDirect($request);
}

?>