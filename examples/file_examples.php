<?php

require_once(__DIR__.'/../src/ClientContext.php');
require_once(__DIR__.'/../src/auth/AuthenticationContext.php');
require_once 'Settings.php';



try {
    $authCtx = new SharePoint\PHP\Client\AuthenticationContext($Settings['Url']);
    $authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
    $ctx = new SharePoint\PHP\Client\ClientContext($Settings['Url'],$authCtx);

    //readFileFromLibrary($ctx);
    //downloadFile($ctx);
    uploadFile($ctx);

}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}



function uploadFile(SharePoint\PHP\Client\ClientContext $ctx)
{
    $fileContent = file_get_contents('./SharePoint User Guide.docx');
    $targetFileUrl = "/sites/news/Documents/SharePoint User Guide2.docx";
    SharePoint\PHP\Client\File::SaveBinaryDirect($ctx,$targetFileUrl,$fileContent);
    print "File has been uploaded'\r\n";
}


function downloadFile(SharePoint\PHP\Client\ClientContext $ctx){
    $sourceFileUrl = "/sites/news/Documents/SharePoint User Guide.docx";
    $fileContent = SharePoint\PHP\Client\File::OpenBinaryDirect($ctx,$sourceFileUrl);
    file_put_contents('./SharePoint User Guide.docx', $fileContent);
    print "File has been downloaded'\r\n";
}

function readFileFromLibrary(SharePoint\PHP\Client\ClientContext $ctx){
    $sourceFileUrl = "/sites/news/Documents/SharePoint User Guide.docx";
    $file = $ctx->getWeb()->getFileByUrl($sourceFileUrl);
    $ctx->load($file);
    $ctx->executeQuery();
    print "File name: '{$file->Name}'\r\n";
}

?>