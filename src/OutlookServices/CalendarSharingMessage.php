<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\OutlookServices;

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
}