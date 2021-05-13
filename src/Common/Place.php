<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\Common;

use Office365\Entity;

/**
 *  "Represents a place. This is the base type for a room or roomList."
 */
class Place extends Entity
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
     * @return string
     */
    public function getPhone()
    {
        if (!$this->isPropertyAvailable("Phone")) {
            return null;
        }
        return $this->getProperty("Phone");
    }
    /**
     * @var string
     */
    public function setPhone($value)
    {
        $this->setProperty("Phone", $value, true);
    }
}