<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Teams;

use Office365\Common\IdentitySet;
use Office365\Runtime\ClientValue;
class MeetingParticipantInfo extends ClientValue
{
    /**
     * @var IdentitySet
     */
    public $Identity;
    /**
     * @var string
     */
    public $Upn;
}