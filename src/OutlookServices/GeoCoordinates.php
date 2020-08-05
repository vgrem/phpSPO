<?php

namespace Office365\OutlookServices;


use Office365\Runtime\ClientValue;

/**
 * The geographic coordinates and elevation of the location.
 */
class GeoCoordinates extends ClientValue
{
    /**
     * The altitude of the location.
     * @var double
     */
    public $Altitude;

    /**
     * The latitude of the location.
     * @var double
     */
    public $Latitude;


    /**
     * The longitude of the location.
     * @var double
     */
    public $Longitude;


    /**
     * The accuracy of the sensor providing the latitude and longitude.
     * @var double
     */
    public $Accuracy;


    /**
     * The accuracy of the sensor providing the altitude.
     * @var double
     */
    public $AltitudeAccuracy;

}