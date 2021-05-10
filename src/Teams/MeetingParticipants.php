<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\Teams;

use Office365\Runtime\ClientValue;
class MeetingParticipants extends ClientValue
{
    /**
     * @var MeetingParticipantInfo
     */
    public $Organizer;
}