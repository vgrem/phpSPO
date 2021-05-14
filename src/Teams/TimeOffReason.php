<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\Teams;

use Office365\Entity;
/**
 * Represents a valid reason to for a [timeOff](timeoff.md) instance in a [schedule](schedule.md).
 */
class TimeOffReason extends Entity
{
    /**
     * @return string
     */
    public function getDisplayName()
    {
        if (!$this->isPropertyAvailable("DisplayName")) {
            return null;
        }
        return $this->getProperty("DisplayName");
    }
    /**
     * @var string
     */
    public function setDisplayName($value)
    {
        $this->setProperty("DisplayName", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsActive()
    {
        if (!$this->isPropertyAvailable("IsActive")) {
            return null;
        }
        return $this->getProperty("IsActive");
    }
    /**
     * @var bool
     */
    public function setIsActive($value)
    {
        $this->setProperty("IsActive", $value, true);
    }
}