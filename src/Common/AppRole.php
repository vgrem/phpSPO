<?php

/**
 * Modified: 2020-05-24T22:08:35+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class AppRole extends ClientValue
{
    /**
     * @var array
     */
    public $AllowedMemberTypes;
    /**
     * @var string
     */
    public $Description;
    /**
     * @var string
     */
    public $DisplayName;
    /**
     * @var string
     */
    public $Id;
    /**
     * @var bool
     */
    public $IsEnabled;
    /**
     * @var string
     */
    public $Origin;
    /**
     * @var string
     */
    public $Value;
}