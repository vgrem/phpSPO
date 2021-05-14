<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\OutlookServices;

use Office365\Runtime\ClientValue;
class PatternedRecurrence extends ClientValue
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