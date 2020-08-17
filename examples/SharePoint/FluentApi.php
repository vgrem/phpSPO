<?php

use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\ResourcePath;


$settings = include('../../Settings.php');
require_once '../vendor/autoload.php';

$fileUrl = "/Shared Documents/Sample - #2009.rtf";


$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$file = (new ClientContext($settings['Url']))->withCredentials($credentials)
    ->getWeb()->getFileByServerRelativePath(new ResourcePath($fileUrl))->get()->executeQuery();

print "File name: {$file->getName()}\r\n";


