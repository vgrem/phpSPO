<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Entity;
use Office365\Runtime\ResourcePath;
class ActivityHistoryItem extends Entity
{
    /**
     * @return integer
     */
    public function getActiveDurationSeconds()
    {
        return $this->getProperty("ActiveDurationSeconds");
    }
    /**
     * @var integer
     */
    public function setActiveDurationSeconds($value)
    {
        $this->setProperty("ActiveDurationSeconds", $value, true);
    }
    /**
     * @return string
     */
    public function getUserTimezone()
    {
        return $this->getProperty("UserTimezone");
    }
    /**
     * @var string
     */
    public function setUserTimezone($value)
    {
        $this->setProperty("UserTimezone", $value, true);
    }
    /**
     * @return UserActivity
     */
    public function getActivity()
    {
        return $this->getProperty("Activity",
            new UserActivity($this->getContext(), new ResourcePath("Activity", $this->getResourcePath())));
    }
}