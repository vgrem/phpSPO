<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Outlook;

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