<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
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
}