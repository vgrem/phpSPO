<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Entity;
use Office365\Runtime\ResourcePath;
/**
 *  "A message that represents a meeting request, cancellation, or response (which can be one of the following
 */
class EventMessage extends Entity
{
    /**
     *  The event associated with the event message. The assumption for attendees or room resources is that the Calendar Attendant is set to automatically update the calendar with an event when meeting request event messages arrive. Navigation property.  Read-only.
     * @return Event
     */
    public function getEvent()
    {
        return $this->getProperty("Event",
            new Event($this->getContext(), new ResourcePath("Event", $this->getResourcePath())));
    }
    /**
     * @return bool
     */
    public function getIsOutOfDate()
    {
        return $this->getProperty("IsOutOfDate");
    }
    /**
     * @var bool
     */
    public function setIsOutOfDate($value)
    {
        $this->setProperty("IsOutOfDate", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsAllDay()
    {
        return $this->getProperty("IsAllDay");
    }
    /**
     * @var bool
     */
    public function setIsAllDay($value)
    {
        $this->setProperty("IsAllDay", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsDelegated()
    {
        return $this->getProperty("IsDelegated");
    }
    /**
     * @var bool
     */
    public function setIsDelegated($value)
    {
        $this->setProperty("IsDelegated", $value, true);
    }
}