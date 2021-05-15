<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\OutlookServices;

use Office365\Common\DaylightTimeZoneOffset;
use Office365\Common\StandardTimeZoneOffset;

class CustomTimeZone extends TimeZoneBase
{
    /**
     * @var integer
     */
    public $Bias;
    /**
     * @var StandardTimeZoneOffset
     */
    public $StandardOffset;
    /**
     * @var DaylightTimeZoneOffset
     */
    public $DaylightOffset;
}