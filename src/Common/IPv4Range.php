<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class IPv4Range extends ClientValue
{
    /**
     * @var string
     */
    public $LowerAddress;
    /**
     * @var string
     */
    public $UpperAddress;
}