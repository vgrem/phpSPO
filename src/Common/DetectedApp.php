<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

class DetectedApp extends ClientObject
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
    public function getVersion()
    {
        if (!$this->isPropertyAvailable("Version")) {
            return null;
        }
        return $this->getProperty("Version");
    }
    /**
     * @var string
     */
    public function setVersion($value)
    {
        $this->setProperty("Version", $value, true);
    }
    /**
     * @return integer
     */
    public function getSizeInByte()
    {
        if (!$this->isPropertyAvailable("SizeInByte")) {
            return null;
        }
        return $this->getProperty("SizeInByte");
    }
    /**
     * @var integer
     */
    public function setSizeInByte($value)
    {
        $this->setProperty("SizeInByte", $value, true);
    }
    /**
     * @return integer
     */
    public function getDeviceCount()
    {
        if (!$this->isPropertyAvailable("DeviceCount")) {
            return null;
        }
        return $this->getProperty("DeviceCount");
    }
    /**
     * @var integer
     */
    public function setDeviceCount($value)
    {
        $this->setProperty("DeviceCount", $value, true);
    }
}