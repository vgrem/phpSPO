<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00
 */
namespace Office365\Intune;

use Office365\Runtime\ClientValue;
class ManagedAppPolicyDeploymentSummaryPerApp extends ClientValue
{
    /**
     * @var integer
     */
    public $ConfigurationAppliedUserCount;
    /**
     * @var MobileAppIdentifier
     */
    public $MobileAppIdentifier;
}