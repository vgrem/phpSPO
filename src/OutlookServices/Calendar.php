<?php

namespace Office365\OutlookServices;
use DateTime;
use Office365\Runtime\ReadEntityQuery;
use Office365\Runtime\ResourcePath;


/**
 * A calendar which is a container for events.
 */
class Calendar extends OutlookEntity
{

    /**
     * @param \DateTime $startDateTime
     * @param \DateTime $endDateTime
     * @return EventCollection
     */
    public function getCalendarView($startDateTime, $endDateTime)
    {
        $url = "CalendarView?startDateTime=" . rawurlencode($startDateTime->format(DateTime::ISO8601))
            . "&endDateTime=" . rawurlencode($endDateTime->format(DateTime::W3C));
        $events = new EventCollection(
            $this->getContext(),
            new ResourcePath($url,$this->getResourcePath())
        );
        $qry = new ReadEntityQuery($events);
        $this->getContext()->addQueryAndResultObject($qry,$events);
        return $events;
    }

    /**
     * The calendar name.
     * @var string
     */
    public $Name;


    /**
     * Specifies the color theme to distinguish the calendar from other calendars in a UI.
     * @var int
     */
    public $Color;


    /**
     * The calendar view for the calendar. Navigation property.
     * @var array
     */
    public $CalendarView;


    /**
     * The events in the calendar. Navigation property.
     * @var array
     */
    public $Events;
}