<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00
 */
namespace Office365\OutlookServices;

use Office365\Runtime\ClientValue;
class OutlookGeoCoordinates extends ClientValue
{
    /**
     * @var double
     */
    public $Latitude;
    /**
     * @var double
     */
    public $Longitude;
    /**
     * @var double
     */
    public $Accuracy;
    /**
     * @var double
     */
    public $Altitude;
    /**
     * @var double
     */
    public $AltitudeAccuracy;
}