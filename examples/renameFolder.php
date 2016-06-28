<?php

require_once(__DIR__ . '/../src/runtime/ClientRequest.php');
require_once(__DIR__ . '/../src/runtime/auth/AuthenticationContext.php');
require_once 'Settings.php';

use SharePoint\PHP\Client\AuthenticationContext;
use SharePoint\PHP\Client\ClientRequest;


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


function renameFolder($url, $authCtx, $folderUrl,$folderNewName)
{
    $request = ClientRequest::create($url,$authCtx);
    $requestOptions = array(
        'url' => $url . "/_api/web/getFolderByServerRelativeUrl('{$folderUrl}')/ListItemAllFields"
    );
    $data = $request->executeQueryDirect($requestOptions);

    $itemPayload = array( 
        '__metadata' => array ('type' => $data->d->__metadata->type),
        'Title' => $folderNewName,
        'FileLeafRef' => $folderNewName
        );
    $itemUrl = $data->d->__metadata->uri;
    $requestOptions = array(
        'url' => $itemUrl,
        'headers' => array(
            "X-HTTP-Method" => "MERGE",
            "If-Match" => "*"
        ),
        'data' => $itemPayload
    );
    $data = $request->executeQueryDirect($requestOptions);
}

?>