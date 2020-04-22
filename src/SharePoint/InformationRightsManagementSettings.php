<?php

/**
 * Updated By PHP Office365 Generator 2019-11-16T19:23:36+00:00 16.0.19506.12022
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValueObject;
/**
 * A 
 * collection of Information Rights Management 
 * (IRM) settings for a list.<201>
 */
class InformationRightsManagementSettings extends ClientValueObject
{
    public $AllowPrint;
    public $AllowScript;
    public $AllowWriteCopy;
    public $DisableDocumentBrowserView;
    public $DocumentAccessExpireDays;
    public $DocumentLibraryProtectionExpireDate;
    public $EnableDocumentAccessExpire;
    public $EnableDocumentBrowserPublishingView;
    public $EnableGroupProtection;
    public $EnableLicenseCacheExpire;
    public $GroupName;
    public $LicenseCacheExpireDays;
    public $PolicyDescription;
    public $PolicyTitle;

}