<?php


namespace Office365\SharePoint\TenantAdministration;

use Office365\Runtime\ClientValue;

/**
 * Sets the initial properties for a new site when it is created.
 * @package Office365\SharePoint\TenantAdministration
 */
class SiteCreationProperties extends ClientValue
{

    /**
     * Gets or sets the compatibility level of the new site.
     * @var $CompatibilityLevel int
     */
    public $CompatibilityLevel;


    /**
     * Gets or sets the locale ID of the new site.
     * @var $Lcid int
     */
    public $Lcid;


    /**
     * Gets or sets the login name of the owner of the new site.
     * @var $Owner string
     */
    public $Owner;


    /**
     * Gets or sets the storage quota of the new site.
     * @var $StorageMaximumLevel int
     */
    public $StorageMaximumLevel;


    /**
     * Gets or sets the amount of storage usage on the new site that triggers a warning.
     * @var $StorageWarningLevel int
     */
    public $StorageWarningLevel;

}