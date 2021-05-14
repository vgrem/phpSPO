<?php

/**
 * Modified: 2020-05-25T06:42:59+00:00 
 */
namespace Office365\OneDrive;

use Office365\Common\IdentitySet;
use Office365\Runtime\ClientValue;
class Shared extends ClientValue
{
    /**
     * @var string
     */
    public $Scope;
    /**
     * @var IdentitySet
     */
    public $Owner;
    /**
     * @var IdentitySet
     */
    public $SharedBy;
}