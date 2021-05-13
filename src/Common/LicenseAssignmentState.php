<?php

/**
 * Modified: 2020-05-24T21:58:36+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class LicenseAssignmentState extends ClientValue
{
    /**
     * @var string
     */
    public $SkuId;
    /**
     * @var array
     */
    public $DisabledPlans;
    /**
     * @var string
     */
    public $AssignedByGroup;
    /**
     * @var string
     */
    public $State;
    /**
     * @var string
     */
    public $Error;
}