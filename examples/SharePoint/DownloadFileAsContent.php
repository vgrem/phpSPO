<?php


use Office365\SharePoint\ClientContext;


$settings = include('../../Settings.php');
require_once '../vendor/autoload.php';

$sourceFileUrl = rawurlencode("/Shared Documents/SharePoint User Guide.docx");
$targetPath = "../data/SharePoint User Guide.docx";


$ctx = ClientContext::connectWithClientCredentials($settings['Url'],$settings['ClientId'], $settings['ClientSecret']);
$fileContent = Office365\SharePoint\File::openBinary($ctx, $sourceFileUrl);
print "File {$targetPath} has been downloaded successfully\r\n";
$fileName = join(DIRECTORY_SEPARATOR,[sys_get_temp_dir(),"SharePoint User Guide.docx"]);
file_put_contents($fileName,$fileContent);

