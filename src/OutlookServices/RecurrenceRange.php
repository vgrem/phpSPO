<?php


namespace Office365\OutlookServices;

use Office365\Runtime\ClientValue;

/**
 * The duration of an event.
 */
class RecurrenceRange extends ClientValue
{

    /**
     * The recurrence range: EndDate = 0, NoEnd = 1, Numbered = 2.
     * @var int
     */
    public $Type;


    /**
     * The start date of the series.
     * @var string
     */
    public $StartDate;


    /**
     * The end date of the series.
     * @var string
     */
    public $EndDate;


    /**
     * How many times to repeat the event.
     * @var int
     */
    public $NumberOfOccurrences;

}