<?php
require_once '../../vendor/autoload.php';
$settings = include('../../../tests/Settings.php');


use Office365\Runtime\Auth\ClientCredential;
use Office365\Runtime\Http\RequestException;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\File;

/**
 * @param File $file
 * @throws RequestException
 */
function tryGetFile($file){
    try {
        $file->get()->executeQuery();
    }
    catch (RequestException $ex){
        if($ex->getCode() === 404){
            return false;
        }
        throw $ex;
    }
    return true;
}

$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$ctx = (new ClientContext($settings['TeamSiteUrl']))->withCredentials($credentials);

$fileUrl = "/sites/team/Shared Documents/Archive/404File.pdf";
$file = $ctx->getWeb()->getFileByServerRelativeUrl($fileUrl);
try {
    if (!tryGetFile($file)) {
        echo "File not found:", $fileUrl;
    }
    echo $file->getName();
} catch (Exception $e) {
    echo "An error occurred:", $e->getMessage();
}

