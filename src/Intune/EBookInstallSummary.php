<?php

/**
 *  2025-08-22T05:37:38+00:00 
 */
namespace Office365\Intune;

use Office365\Entity;

class EBookInstallSummary extends Entity
{
    /**
     * @return integer
     */
    public function getInstalledDeviceCount()
    {
        return $this->getProperty("InstalledDeviceCount");
    }
    /**
     * @var integer
     */
    public function setInstalledDeviceCount($value)
    {
        return $this->setProperty("InstalledDeviceCount", $value, true);
    }
    /**
     * @return integer
     */
    public function getFailedDeviceCount()
    {
        return $this->getProperty("FailedDeviceCount");
    }
    /**
     * @var integer
     */
    public function setFailedDeviceCount($value)
    {
        return $this->setProperty("FailedDeviceCount", $value, true);
    }
    /**
     * @return integer
     */
    public function getNotInstalledDeviceCount()
    {
        return $this->getProperty("NotInstalledDeviceCount");
    }
    /**
     * @var integer
     */
    public function setNotInstalledDeviceCount($value)
    {
        return $this->setProperty("NotInstalledDeviceCount", $value, true);
    }
    /**
     * @return integer
     */
    public function getInstalledUserCount()
    {
        return $this->getProperty("InstalledUserCount");
    }
    /**
     * @var integer
     */
    public function setInstalledUserCount($value)
    {
        return $this->setProperty("InstalledUserCount", $value, true);
    }
    /**
     * @return integer
     */
    public function getFailedUserCount()
    {
        return $this->getProperty("FailedUserCount");
    }
    /**
     * @var integer
     */
    public function setFailedUserCount($value)
    {
        return $this->setProperty("FailedUserCount", $value, true);
    }
    /**
     * @return integer
     */
    public function getNotInstalledUserCount()
    {
        return $this->getProperty("NotInstalledUserCount");
    }
    /**
     * @var integer
     */
    public function setNotInstalledUserCount($value)
    {
        return $this->setProperty("NotInstalledUserCount", $value, true);
    }
}