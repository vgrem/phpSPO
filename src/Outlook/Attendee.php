<?php

/**
 *  2025-08-21T20:35:45+00:00 
 */
namespace Office365\Outlook;

use Office365\Teams\TimeSlot;

class Attendee extends Recipient
{
    /**
     * @var ResponseStatus
     */
    public $Status;
    /**
     * @var TimeSlot
     */
    public $ProposedNewTime;
}