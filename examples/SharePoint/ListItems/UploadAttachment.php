<?php

require_once './../../vendor/autoload.php';
$settings = include('./../../../tests/Settings.php');


use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\AttachmentCreationInformation;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\FieldLookupValue;
use Office365\SharePoint\FieldMultiChoiceValue;
use Office365\SharePoint\FieldMultiLookupValue;
use Office365\SharePoint\FieldUserValue;
use Office365\SharePoint\ListItem;

$credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']);
$siteUrl = $settings['TeamSiteUrl'];
$ctx = (new ClientContext($siteUrl))->withCredentials($credentials);



$list = $ctx->getWeb()->getLists()->getByTitle("Tasks");
$taskProps = array(
    'Title' => "New task N#" . rand(1, 100000)

);
$listItem = $list->addItem($taskProps);

$localPath = "../../data/SharePoint User Guide.docx";
$listItem->getAttachmentFiles()->add($localPath)->executeQuery();


