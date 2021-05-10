<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Teams;

use Office365\Runtime\ClientValue;
class AudioConferencing extends ClientValue
{
    /**
     * @var string
     */
    public $ConferenceId;
    /**
     * @var string
     */
    public $TollNumber;
    /**
     * @var string
     */
    public $TollFreeNumber;
    /**
     * @var string
     */
    public $DialinUrl;
}