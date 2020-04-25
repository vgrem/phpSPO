<?php

/**
 * Updated By PHP Office365 Generator 2020-04-25T20:52:14+00:00 16.0.20008.12009
 */
namespace Office365\OutlookServices;

use Office365\Runtime\ClientValueObject;
class PatternedRecurrence extends ClientValueObject
{
    /**
     * @var RecurrencePattern
     */
    public $Pattern;
    /**
     * @var RecurrenceRange
     */
    public $Range;
}