<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class ServicePlanInfo extends ClientValue
{
    /**
     * @var string
     */
    public $ServicePlanId;
    /**
     * @var string
     */
    public $ServicePlanName;
    /**
     * @var string
     */
    public $ProvisioningStatus;
    /**
     * @var string
     */
    public $AppliesTo;
}