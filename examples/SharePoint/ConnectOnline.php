<?php

require_once __DIR__ . '/../vendor/autoload.php';
$settings = include( __DIR__ . '/../../Settings.php');


use Office365\SharePoint\ClientContext;
use Office365\SharePoint\MoveOperations;


try {
    $ctx = ClientContext::connectWithUserCredentials($settings['Url'], $settings['UserName'], $settings['Password']);
    //$ctx = ClientContext::connectWithClientCredentials($Settings['Url'], $Settings['ClientId'], $Settings['ClientSecret']);
    $site = $ctx->getSite();
    $ctx->load($site); //load site settings
    $ctx->executeQuery();
    print $site->getUrl();


    $sourceFile = $ctx->getWeb()->getFileByServerRelativeUrl("/sites/team/Shared Documents/sample1234.docx");
    $ctx->load($sourceFile);
    $targetFile = $sourceFile->moveTo("/sites/team/Shared Documents/sample.docx", MoveOperations::Overwrite);
    $ctx->executeQuery();

}
catch (Exception $e) {
	echo 'Authentication failed: ',  $e->getMessage(), "\n";
}
