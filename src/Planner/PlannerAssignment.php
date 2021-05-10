<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Planner;

use Office365\Common\IdentitySet;
use Office365\Runtime\ClientValue;
class PlannerAssignment extends ClientValue
{
    /**
     * @var IdentitySet
     */
    public $AssignedBy;
    /**
     * @var string
     */
    public $OrderHint;
}