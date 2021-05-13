<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;
class EnrollmentTroubleshootingEvent extends ClientObject
{
    /**
     * @return string
     */
    public function getManagedDeviceIdentifier()
    {
        if (!$this->isPropertyAvailable("ManagedDeviceIdentifier")) {
            return null;
        }
        return $this->getProperty("ManagedDeviceIdentifier");
    }
    /**
     * @var string
     */
    public function setManagedDeviceIdentifier($value)
    {
        $this->setProperty("ManagedDeviceIdentifier", $value, true);
    }
    /**
     * @return string
     */
    public function getOperatingSystem()
    {
        if (!$this->isPropertyAvailable("OperatingSystem")) {
            return null;
        }
        return $this->getProperty("OperatingSystem");
    }
    /**
     * @var string
     */
    public function setOperatingSystem($value)
    {
        $this->setProperty("OperatingSystem", $value, true);
    }
    /**
     * @return string
     */
    public function getOsVersion()
    {
        if (!$this->isPropertyAvailable("OsVersion")) {
            return null;
        }
        return $this->getProperty("OsVersion");
    }
    /**
     * @var string
     */
    public function setOsVersion($value)
    {
        $this->setProperty("OsVersion", $value, true);
    }
    /**
     * @return string
     */
    public function getUserId()
    {
        if (!$this->isPropertyAvailable("UserId")) {
            return null;
        }
        return $this->getProperty("UserId");
    }
    /**
     * @var string
     */
    public function setUserId($value)
    {
        $this->setProperty("UserId", $value, true);
    }
    /**
     * @return string
     */
    public function getDeviceId()
    {
        if (!$this->isPropertyAvailable("DeviceId")) {
            return null;
        }
        return $this->getProperty("DeviceId");
    }
    /**
     * @var string
     */
    public function setDeviceId($value)
    {
        $this->setProperty("DeviceId", $value, true);
    }
    /**
     * @return string
     */
    public function getFailureReason()
    {
        if (!$this->isPropertyAvailable("FailureReason")) {
            return null;
        }
        return $this->getProperty("FailureReason");
    }
    /**
     * @var string
     */
    public function setFailureReason($value)
    {
        $this->setProperty("FailureReason", $value, true);
    }
}