<?php

/**
 *  2025-08-22T05:43:25+00:00 
 */
namespace Office365\Teams;

use Office365\Entity;
/**
 * Represents a unit of scheduled work in a [schedule](schedule.md). 
 */
class Shift extends Entity
{
    /**
     * @return string
     */
    public function getUserId()
    {
        if (!$this->isPropertyAvailable("UserId")) {
            return null;
        }
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
     * @return string
     */
    public function getSchedulingGroupId()
    {
        if (!$this->isPropertyAvailable("SchedulingGroupId")) {
            return null;
        }
        return $this->getProperty("SchedulingGroupId");
    }
    /**
     * @var string
     */
    public function setSchedulingGroupId($value)
    {
        $this->setProperty("SchedulingGroupId", $value, true);
    }
    /**
     * @return ShiftItem
     */
    public function getSharedShift()
    {
        return $this->getProperty("SharedShift");
    }
    /**
     * @var ShiftItem
     */
    public function setSharedShift($value)
    {
        return $this->setProperty("SharedShift", $value, true);
    }
    /**
     * @return ShiftItem
     */
    public function getDraftShift()
    {
        return $this->getProperty("DraftShift");
    }
    /**
     * @var ShiftItem
     */
    public function setDraftShift($value)
    {
        return $this->setProperty("DraftShift", $value, true);
    }
}