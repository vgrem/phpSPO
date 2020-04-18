<?php

use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use Office365\PHP\Client\SharePoint\ClientContext;


$settings = include('../../Settings.php');
require_once '../vendor/autoload.php';

$sourceFileUrl = rawurlencode("/Shared Documents/SharePoint User Guide.docx");
$targetPath = "../data/SharePoint User Guide.docx";


$ctx = ClientContext::connectWithClientCredentials($settings['Url'],$settings['ClientId'], $settings['ClientSecret']);
$fp = fopen($targetPath, 'w+');
$url = $ctx->getServiceRootUrl() . "web/getfilebyserverrelativeurl('$sourceFileUrl')/\$value";
$options = new RequestOptions($url);
$options->StreamHandle = $fp;
$ctx->executeQueryDirect($options);
fclose($fp);
print "File {$targetPath} has been downloaded successfully\r\n";

