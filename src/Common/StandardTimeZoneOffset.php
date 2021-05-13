<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class StandardTimeZoneOffset extends ClientValue
{
    /**
     * @var integer
     */
    public $DayOccurrence;
    /**
     * @var integer
     */
    public $Month;
    /**
     * @var integer
     */
    public $Year;
}