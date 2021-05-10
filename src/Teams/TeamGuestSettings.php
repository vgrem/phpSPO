<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Teams;

use Office365\Runtime\ClientValue;
class TeamGuestSettings extends ClientValue
{
    /**
     * @var bool
     */
    public $AllowCreateUpdateChannels;
    /**
     * @var bool
     */
    public $AllowDeleteChannels;
}