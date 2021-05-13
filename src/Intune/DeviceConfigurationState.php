<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Intune;

use Office365\Entity;


class DeviceConfigurationState extends Entity
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
     * @return integer
     */
    public function getVersion()
    {
        return $this->getProperty("Version");
    }
    /**
     * @var integer
     */
    public function setVersion($value)
    {
        $this->setProperty("Version", $value, true);
    }
    /**
     * @return integer
     */
    public function getSettingCount()
    {
        if (!$this->isPropertyAvailable("SettingCount")) {
            return null;
        }
        return $this->getProperty("SettingCount");
    }
    /**
     * @var integer
     */
    public function setSettingCount($value)
    {
        $this->setProperty("SettingCount", $value, true);
    }
}