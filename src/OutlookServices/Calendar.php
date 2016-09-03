<?php

namespace Office365\PHP\Client\OutlookServices;
use Office365\PHP\Client\Runtime\ClientAction;


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
        $events = new EventCollection($this->getContext());
        $qry = new ClientAction($this->getResourceUrl() . "/CalendarView?startDateTime=$startDateTime&endDateTime=$endDateTime");
        $this->getContext()->addQuery($qry,$events);
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