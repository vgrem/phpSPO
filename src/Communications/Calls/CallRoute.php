<?php

/**
 *  2025-08-22T05:41:05+00:00 
 */
namespace Office365\Communications\Calls;

use Office365\Directory\Identities\IdentitySet;
use Office365\Runtime\ClientValue;
class CallRoute extends ClientValue
{
    /**
     * @var IdentitySet
     */
    public $Original;
    /**
     * @var IdentitySet
     */
    public $Final;
}