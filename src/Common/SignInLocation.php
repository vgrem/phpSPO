<?php

/**
 * Modified: 2020-05-24T21:52:14+00:00 
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class SignInLocation extends ClientValue
{
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
     * @var GeoCoordinates
     */
    public $GeoCoordinates;
}