<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Planner\Tasks;

use Office365\Directory\Identities\IdentitySet;
use Office365\Runtime\ClientValue;
class PlannerChecklistItem extends ClientValue
{
    /**
     * @var bool
     */
    public $IsChecked;
    /**
     * @var string
     */
    public $Title;
    /**
     * @var string
     */
    public $OrderHint;
    /**
     * @var IdentitySet
     */
    public $LastModifiedBy;
}