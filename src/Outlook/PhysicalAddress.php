<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00 
 */
namespace Office365\Outlook;

use Office365\Complex;

class PhysicalAddress extends Complex
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