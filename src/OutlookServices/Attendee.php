<?php


namespace Office365\PHP\Client\OutlookServices;


class Attendee extends Recipient
{

    /**
     * @var ResponseStatus
     */
    public $Status;

    /**
     * @var string
     */
    public $Type;

}