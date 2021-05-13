<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Runtime\ClientValue;
class PhysicalAddress extends ClientValue
{
    /**
     * @var string
     */
    public $Street;
    /**
     * @var string
     */
    public $City;
    /**
     * @var string
     */
    public $State;
    /**
     * @var string
     */
    public $CountryOrRegion;
    /**
     * @var string
     */
    public $PostalCode;
}