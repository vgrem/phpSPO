<?php


namespace Office365\PHP\Client\OutlookServices;


class Event extends OutlookEntity
{

    /**
     * @var string
     */
    public $Subject;


    /**
     * @var ItemBody
     */
    public $Body;


    /**
     * @var array
     */
    public $Attendees;


    /**
     * @var Location
     */
    public $Location;
}