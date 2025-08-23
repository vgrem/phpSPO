<?php

/**
 *  2025-08-22T05:43:25+00:00 
 */
namespace Office365\Teams;

use Office365\Outlook\PatternedRecurrence;
use Office365\Runtime\ClientValue;
class ShiftAvailability extends ClientValue
{
    /**
     * @var string
     */
    public $TimeZone;
    /**
     * @var PatternedRecurrence
     */
    public $Recurrence;
}