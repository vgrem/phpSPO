<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\Common;

use Office365\Entity;

/**
 *  "Specifies the properties of a room in a tenant."
 */
class Room extends Entity
{
    /**
     * @return string
     */
    public function getEmailAddress()
    {
        if (!$this->isPropertyAvailable("EmailAddress")) {
            return null;
        }
        return $this->getProperty("EmailAddress");
    }
    /**
     * @var string
     */
    public function setEmailAddress($value)
    {
        $this->setProperty("EmailAddress", $value, true);
    }
    /**
     * @return string
     */
    public function getNickname()
    {
        if (!$this->isPropertyAvailable("Nickname")) {
            return null;
        }
        return $this->getProperty("Nickname");
    }
    /**
     * @var string
     */
    public function setNickname($value)
    {
        $this->setProperty("Nickname", $value, true);
    }
    /**
     * @return string
     */
    public function getBuilding()
    {
        return $this->getProperty("Building");
    }
    /**
     * @var string
     */
    public function setBuilding($value)
    {
        $this->setProperty("Building", $value, true);
    }
    /**
     * @return integer
     */
    public function getFloorNumber()
    {
        if (!$this->isPropertyAvailable("FloorNumber")) {
            return null;
        }
        return $this->getProperty("FloorNumber");
    }
    /**
     * @var integer
     */
    public function setFloorNumber($value)
    {
        $this->setProperty("FloorNumber", $value, true);
    }
    /**
     * @return string
     */
    public function getLabel()
    {
        if (!$this->isPropertyAvailable("Label")) {
            return null;
        }
        return $this->getProperty("Label");
    }
    /**
     * @var string
     */
    public function setLabel($value)
    {
        $this->setProperty("Label", $value, true);
    }
    /**
     * @return integer
     */
    public function getCapacity()
    {
        return $this->getProperty("Capacity");
    }
    /**
     * @var integer
     */
    public function setCapacity($value)
    {
        $this->setProperty("Capacity", $value, true);
    }
    /**
     * @return string
     */
    public function getAudioDeviceName()
    {
        if (!$this->isPropertyAvailable("AudioDeviceName")) {
            return null;
        }
        return $this->getProperty("AudioDeviceName");
    }
    /**
     * @var string
     */
    public function setAudioDeviceName($value)
    {
        $this->setProperty("AudioDeviceName", $value, true);
    }
    /**
     * @return string
     */
    public function getVideoDeviceName()
    {
        if (!$this->isPropertyAvailable("VideoDeviceName")) {
            return null;
        }
        return $this->getProperty("VideoDeviceName");
    }
    /**
     * @var string
     */
    public function setVideoDeviceName($value)
    {
        $this->setProperty("VideoDeviceName", $value, true);
    }
    /**
     * @return string
     */
    public function getDisplayDeviceName()
    {
        if (!$this->isPropertyAvailable("DisplayDeviceName")) {
            return null;
        }
        return $this->getProperty("DisplayDeviceName");
    }
    /**
     * @var string
     */
    public function setDisplayDeviceName($value)
    {
        $this->setProperty("DisplayDeviceName", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsWheelChairAccessible()
    {
        if (!$this->isPropertyAvailable("IsWheelChairAccessible")) {
            return null;
        }
        return $this->getProperty("IsWheelChairAccessible");
    }
    /**
     * @var bool
     */
    public function setIsWheelChairAccessible($value)
    {
        $this->setProperty("IsWheelChairAccessible", $value, true);
    }
    /**
     * @return array
     */
    public function getTags()
    {
        if (!$this->isPropertyAvailable("Tags")) {
            return null;
        }
        return $this->getProperty("Tags");
    }
    /**
     * @var array
     */
    public function setTags($value)
    {
        $this->setProperty("Tags", $value, true);
    }
    /**
     * @return string
     */
    public function getFloorLabel()
    {
        if (!$this->isPropertyAvailable("FloorLabel")) {
            return null;
        }
        return $this->getProperty("FloorLabel");
    }
    /**
     * @var string
     */
    public function setFloorLabel($value)
    {
        $this->setProperty("FloorLabel", $value, true);
    }
}