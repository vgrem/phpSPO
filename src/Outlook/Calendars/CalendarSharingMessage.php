<?php

/**
 *  2025-08-21T20:35:45+00:00 
 */
namespace Office365\Outlook\Calendars;

use Office365\Entity;
class CalendarSharingMessage extends Entity
{
    /**
     * @return bool
     */
    public function getCanAccept()
    {
        if (!$this->isPropertyAvailable("CanAccept")) {
            return null;
        }
        return $this->getProperty("CanAccept");
    }
    /**
     * @var bool
     */
    public function setCanAccept($value)
    {
        $this->setProperty("CanAccept", $value, true);
    }
    /**
     * @return string
     */
    public function getSuggestedCalendarName()
    {
        if (!$this->isPropertyAvailable("SuggestedCalendarName")) {
            return null;
        }
        return $this->getProperty("SuggestedCalendarName");
    }
    /**
     * @var string
     */
    public function setSuggestedCalendarName($value)
    {
        $this->setProperty("SuggestedCalendarName", $value, true);
    }
    /**
     * @return CalendarSharingMessageAction
     */
    public function getSharingMessageAction()
    {
        return $this->getProperty("SharingMessageAction");
    }
    /**
     * @var CalendarSharingMessageAction
     */
    public function setSharingMessageAction($value)
    {
        return $this->setProperty("SharingMessageAction", $value, true);
    }
}