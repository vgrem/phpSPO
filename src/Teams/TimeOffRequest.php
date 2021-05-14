<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\Teams;

use Office365\Entity;

/**
 * Represents a type of shift request to take [timeOff](../resources/timeoff.md).
 */
class TimeOffRequest extends Entity
{
    /**
     * The reason for the time off.
     * @return string
     */
    public function getTimeOffReasonId()
    {
        return $this->getProperty("TimeOffReasonId");
    }

    /**
     * The reason for the time off.
     *
     * @return self
     * @var string
     */
    public function setTimeOffReasonId($value)
    {
        return $this->setProperty("TimeOffReasonId", $value, true);
    }
}