<?php

/**
 * Modified: 2020-05-24T21:39:44+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class GeoCoordinates extends ClientValue
{
    /**
     * @var double
     */
    public $Altitude;
    /**
     * @var double
     */
    public $Latitude;
    /**
     * @var double
     */
    public $Longitude;
}