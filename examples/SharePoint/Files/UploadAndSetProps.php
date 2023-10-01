<?php


require_once '../../vendor/autoload.php';
$settings = include('../../../tests/Settings.php');

use Office365\Runtime\Auth\UserCredentials;
use Office365\SharePoint\ClientContext;


$credentials = new UserCredentials($settings['UserName'], $settings['Password']);
$ctx = (new ClientContext($settings['Url']))->withCredentials($credentials);

$localPath =  "../../data/SharePoint User Guide.docx";
$libraryTitle = "Documents";
$lib = $ctx->getWeb()->getLists()->getByTitle($libraryTitle);
$uploadFile = $lib->getRootFolder()->uploadFile(basename($localPath),file_get_contents($localPath))->executeQuery();
$listItem = $uploadFile->getListItemAllFields();
$listItem->setProperty("Title", "Uploaded")->update()->executeQuery(); // update file metadata
print "File {$uploadFile->getServerRelativeUrl()} has been uploaded\r\n";


