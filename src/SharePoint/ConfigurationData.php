<?php

/**
 * Generated  2023-09-30T09:13:50+00:00 16.0.24106.12014
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;
class ConfigurationData extends ClientValue
{
    /**
     * @var SPResourcePath
     */
    public $BridgeAbsolutePath;
    /**
     * @var bool
     */
    public $IsPersonalizationEnabled;
    /**
     * @var bool
     */
    public $IsVivaHomeOptedOut;
    /**
     * @var HomeSiteNavConfiguration
     */
    public $NavConfig;
    /**
     * @var string
     */
    public $SiteId;
    /**
     * @var integer
     */
    public $VivaExperienceType;
    /**
     * @var string
     */
    public $WebId;
}