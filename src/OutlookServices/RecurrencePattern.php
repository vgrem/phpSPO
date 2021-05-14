<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00
 */
namespace Office365\OutlookServices;

use Office365\Runtime\ClientValue;
class RecurrencePattern extends ClientValue
{
    /**
     * @var integer
     */
    public $Interval;
    /**
     * @var integer
     */
    public $Month;
    /**
     * @var integer
     */
    public $DayOfMonth;
}