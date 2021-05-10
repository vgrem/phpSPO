<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Teams;

use Office365\Common\TimeSlot;
use Office365\Runtime\ClientValue;
class MeetingTimeSuggestion extends ClientValue
{
    /**
     * @var double
     */
    public $Confidence;
    /**
     * @var integer
     */
    public $Order;
    /**
     * @var string
     */
    public $SuggestionReason;
    /**
     * @var TimeSlot
     */
    public $MeetingTimeSlot;
}