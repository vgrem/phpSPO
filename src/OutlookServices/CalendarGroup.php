<?php

/**
 * Modified: 2020-05-24T22:03:02+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Entity;

/**
 * A group of user calendars.
 */
class CalendarGroup extends Entity
{
    /**
     * @return string
     */
    public function getName()
    {
        if (!$this->isPropertyAvailable("Name")) {
            return null;
        }
        return $this->getProperty("Name");
    }
    /**
     * @var string
     */
    public function setName($value)
    {
        $this->setProperty("Name", $value, true);
    }
    /**
     * @return string
     */
    public function getClassId()
    {
        if (!$this->isPropertyAvailable("ClassId")) {
            return null;
        }
        return $this->getProperty("ClassId");
    }
    /**
     * @var string
     */
    public function setClassId($value)
    {
        $this->setProperty("ClassId", $value, true);
    }
    /**
     * @return string
     */
    public function getChangeKey()
    {
        if (!$this->isPropertyAvailable("ChangeKey")) {
            return null;
        }
        return $this->getProperty("ChangeKey");
    }
    /**
     * @var string
     */
    public function setChangeKey($value)
    {
        $this->setProperty("ChangeKey", $value, true);
    }
}