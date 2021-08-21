<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Planner\Tasks;

use Office365\Directory\Identities\IdentitySet;
use Office365\Runtime\ClientValue;
class PlannerExternalReference extends ClientValue
{
    /**
     * @var string
     */
    public $Alias;
    /**
     * @var string
     */
    public $Type;
    /**
     * @var string
     */
    public $PreviewPriority;
    /**
     * @var IdentitySet
     */
    public $LastModifiedBy;
}