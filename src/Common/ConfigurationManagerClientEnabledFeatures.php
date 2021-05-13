<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class ConfigurationManagerClientEnabledFeatures extends ClientValue
{
    /**
     * @var bool
     */
    public $Inventory;
    /**
     * @var bool
     */
    public $ModernApps;
    /**
     * @var bool
     */
    public $ResourceAccess;
    /**
     * @var bool
     */
    public $DeviceConfiguration;
    /**
     * @var bool
     */
    public $CompliancePolicy;
    /**
     * @var bool
     */
    public $WindowsUpdateForBusiness;
}