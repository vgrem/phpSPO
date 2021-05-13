<?php

/**
 * Modified: 2020-05-24T22:08:35+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class PhysicalOfficeAddress extends ClientValue
{
    /**
     * @var string
     */
    public $City;
    /**
     * @var string
     */
    public $CountryOrRegion;
    /**
     * @var string
     */
    public $OfficeLocation;
    /**
     * @var string
     */
    public $PostalCode;
    /**
     * @var string
     */
    public $State;
    /**
     * @var string
     */
    public $Street;
}