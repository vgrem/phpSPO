<?php

/**
 * Updated By PHP Office365 Generator 2020-04-25T20:49:12+00:00 16.0.20008.12009
 */
namespace Office365\OutlookServices;

/**
 * A group of calendars.
 */
class CalendarGroup extends OutlookEntity
{
    /**
     * @var string
     */
    public $Name;
    /**
     * @var string
     */
    public $ClassId;
    /**
     * @var string
     */
    public $ChangeKey;
    /**
     * @return CalendarCollection
     */
    public function getCalendars()
    {
        if (!$this->isPropertyAvailable("Calendars")) {
            $this->setProperty("Calendars", new CalendarCollection($this->getContext(), new ResourcePath("Calendars", $this->getResourcePath())));
        }
        return $this->getProperty("Calendars");
    }
}