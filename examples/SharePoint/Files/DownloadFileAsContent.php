<?php


use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;


require_once '../../vendor/autoload.php';
$settings = include('../../../tests/Settings.php');

$sourceFileUrl = "/sites/team/Shared Documents/sample.txt";
$targetPath = "../data/SharePoint User Guide.docx";

$appCreds = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$ctx = (new ClientContext($settings['TeamSiteUrl']))->withCredentials($appCreds);
$fileContent = Office365\SharePoint\File::openBinary($ctx, $sourceFileUrl);
print "File {$targetPath} has been downloaded successfully\r\n";
$fileName = join(DIRECTORY_SEPARATOR,[sys_get_temp_dir(),basename($sourceFileUrl)]);
file_put_contents($fileName,$fileContent);

