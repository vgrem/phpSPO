<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00
 */
namespace Office365\OutlookServices;

use Office365\Common\DateTimeTimeZone;
use Office365\Runtime\ClientValue;
class FollowupFlag extends ClientValue
{
    /**
     * @var DateTimeTimeZone
     */
    public $CompletedDateTime;
    /**
     * @var DateTimeTimeZone
     */
    public $DueDateTime;
    /**
     * @var DateTimeTimeZone
     */
    public $StartDateTime;
}