<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Directory\Security;

use Office365\Runtime\ClientValue;
class AlertTrigger extends ClientValue
{
    /**
     * @var string
     */
    public $Name;
    /**
     * @var string
     */
    public $Type;
    /**
     * @var string
     */
    public $Value;
}