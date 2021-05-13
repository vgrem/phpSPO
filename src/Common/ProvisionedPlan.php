<?php

/**
 * Modified: 2020-05-24T22:03:02+00:00 
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class ProvisionedPlan extends ClientValue
{
    /**
     * @var string
     */
    public $CapabilityStatus;
    /**
     * @var string
     */
    public $ProvisioningStatus;
    /**
     * @var string
     */
    public $Service;
}