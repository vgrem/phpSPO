<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Teams;

use Office365\Runtime\ClientValue;
class TeamMessagingSettings extends ClientValue
{
    /**
     * @var bool
     */
    public $AllowUserEditMessages;
    /**
     * @var bool
     */
    public $AllowUserDeleteMessages;
    /**
     * @var bool
     */
    public $AllowOwnerDeleteMessages;
    /**
     * @var bool
     */
    public $AllowTeamMentions;
    /**
     * @var bool
     */
    public $AllowChannelMentions;
}