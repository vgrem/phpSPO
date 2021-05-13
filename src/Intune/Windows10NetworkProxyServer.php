<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Intune;

use Office365\Runtime\ClientValue;
class Windows10NetworkProxyServer extends ClientValue
{
    /**
     * @var string
     */
    public $Address;
    /**
     * @var array
     */
    public $Exceptions;
    /**
     * @var bool
     */
    public $UseForLocalAddresses;
}