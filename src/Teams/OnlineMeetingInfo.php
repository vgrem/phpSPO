<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\Teams;

use Office365\Runtime\ClientValue;
class OnlineMeetingInfo extends ClientValue
{
    /**
     * @var string
     */
    public $JoinUrl;
    /**
     * @var string
     */
    public $ConferenceId;
    /**
     * @var string
     */
    public $TollNumber;
    /**
     * @var array
     */
    public $TollFreeNumbers;
    /**
     * @var string
     */
    public $QuickDial;
}