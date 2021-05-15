<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00
 */
namespace Office365\OutlookServices;

use Office365\Runtime\ClientValue;
class TimeZoneInformation extends ClientValue
{
    /**
     * @var string
     */
    public $Alias;
    /**
     * @var string
     */
    public $DisplayName;
}