<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\Teams;

use Office365\Common\DateTimeTimeZone;
use Office365\Runtime\ClientValue;
class ScheduleItem extends ClientValue
{
    /**
     * @var DateTimeTimeZone
     */
    public $Start;
    /**
     * @var DateTimeTimeZone
     */
    public $End;
    /**
     * @var bool
     */
    public $IsPrivate;
    /**
     * @var string
     */
    public $Subject;
    /**
     * @var string
     */
    public $Location;
}