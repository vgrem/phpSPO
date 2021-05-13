<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class VerifiedDomain extends ClientValue
{
    /**
     * @var string
     */
    public $Capabilities;
    /**
     * @var bool
     */
    public $IsDefault;
    /**
     * @var bool
     */
    public $IsInitial;
    /**
     * @var string
     */
    public $Name;
    /**
     * @var string
     */
    public $Type;
}