<?php


namespace Office365\PHP\Client\OutlookServices;


use Office365\PHP\Client\Runtime\ClientValueObject;

class Location extends ClientValueObject
{

    /**
     * @var string
     */
    public $DisplayName;


    /**
     * @var PhysicalAddress
     */
    public $Address;


    /**
     * @var GeoCoordinates
     */
    public $Coordinates;
}