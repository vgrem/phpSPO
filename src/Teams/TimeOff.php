<?php

/**
 *  2025-08-22T05:43:25+00:00 
 */
namespace Office365\Teams;

/**
 * A unit of non-work in a schedule.
 */
class TimeOff extends ChangeTrackedEntity
{
    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->getProperty("UserId");
    }
    /**
     * @var string
     */
    public function setUserId($value)
    {
        $this->setProperty("UserId", $value, true);
    }
    /**
     * @return TimeOffItem
     */
    public function getSharedTimeOff()
    {
        return $this->getProperty("SharedTimeOff");
    }
    /**
     * @var TimeOffItem
     */
    public function setSharedTimeOff($value)
    {
        return $this->setProperty("SharedTimeOff", $value, true);
    }
    /**
     * @return TimeOffItem
     */
    public function getDraftTimeOff()
    {
        return $this->getProperty("DraftTimeOff");
    }
    /**
     * @var TimeOffItem
     */
    public function setDraftTimeOff($value)
    {
        return $this->setProperty("DraftTimeOff", $value, true);
    }
}