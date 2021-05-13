<?php

/**
 * Modified: 2020-05-24T21:52:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class AssignedPlan extends ClientValue
{
    /**
     * @var string
     */
    public $CapabilityStatus;
    /**
     * @var string
     */
    public $Service;
    /**
     * @var string
     */
    public $ServicePlanId;
}