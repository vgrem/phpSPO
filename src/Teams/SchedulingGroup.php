<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\Teams;

use Office365\Entity;

/**
 * A logical grouping of users in a [schedule](schedule.md) (usually by role). 
 */
class SchedulingGroup extends Entity
{
    /**
     * @return string
     */
    public function getDisplayName()
    {
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
        return $this->getProperty("IsActive");
    }
    /**
     * @var bool
     */
    public function setIsActive($value)
    {
        $this->setProperty("IsActive", $value, true);
    }
    /**
     * @return array
     */
    public function getUserIds()
    {
        return $this->getProperty("UserIds");
    }
    /**
     * @var array
     */
    public function setUserIds($value)
    {
        $this->setProperty("UserIds", $value, true);
    }
}