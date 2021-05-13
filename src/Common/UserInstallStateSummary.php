<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

class UserInstallStateSummary extends ClientObject
{
    /**
     * @return string
     */
    public function getUserName()
    {
        if (!$this->isPropertyAvailable("UserName")) {
            return null;
        }
        return $this->getProperty("UserName");
    }
    /**
     * @var string
     */
    public function setUserName($value)
    {
        $this->setProperty("UserName", $value, true);
    }
    /**
     * @return integer
     */
    public function getInstalledDeviceCount()
    {
        if (!$this->isPropertyAvailable("InstalledDeviceCount")) {
            return null;
        }
        return $this->getProperty("InstalledDeviceCount");
    }
    /**
     * @var integer
     */
    public function setInstalledDeviceCount($value)
    {
        $this->setProperty("InstalledDeviceCount", $value, true);
    }
    /**
     * @return integer
     */
    public function getFailedDeviceCount()
    {
        if (!$this->isPropertyAvailable("FailedDeviceCount")) {
            return null;
        }
        return $this->getProperty("FailedDeviceCount");
    }
    /**
     * @var integer
     */
    public function setFailedDeviceCount($value)
    {
        $this->setProperty("FailedDeviceCount", $value, true);
    }
    /**
     * @return integer
     */
    public function getNotInstalledDeviceCount()
    {
        if (!$this->isPropertyAvailable("NotInstalledDeviceCount")) {
            return null;
        }
        return $this->getProperty("NotInstalledDeviceCount");
    }
    /**
     * @var integer
     */
    public function setNotInstalledDeviceCount($value)
    {
        $this->setProperty("NotInstalledDeviceCount", $value, true);
    }
}