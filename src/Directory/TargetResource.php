<?php

/**
 *  2025-08-21T17:17:47+00:00 
 */
namespace Office365\Directory;

use Office365\Runtime\ClientValue;

class TargetResource extends ClientValue
{
    /**
     * @var string
     */
    public $Id;
    /**
     * @var string
     */
    public $DisplayName;
    /**
     * @var string
     */
    public $Type;
    /**
     * @var string
     */
    public $UserPrincipalName;
}