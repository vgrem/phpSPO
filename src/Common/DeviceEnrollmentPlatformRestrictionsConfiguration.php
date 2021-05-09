<?php

/**
 * Generated by phpSPO model generator 2020-05-26T22:12:31+00:00 
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;
use Office365\Runtime\ResourcePath;
class DeviceEnrollmentPlatformRestrictionsConfiguration extends ClientObject
{
    /**
     * @return DeviceEnrollmentPlatformRestriction
     */
    public function getIosRestriction()
    {
        if (!$this->isPropertyAvailable("IosRestriction")) {
            return null;
        }
        return $this->getProperty("IosRestriction");
    }
    /**
     * @var DeviceEnrollmentPlatformRestriction
     */
    public function setIosRestriction($value)
    {
        $this->setProperty("IosRestriction", $value, true);
    }
    /**
     * @return DeviceEnrollmentPlatformRestriction
     */
    public function getWindowsRestriction()
    {
        if (!$this->isPropertyAvailable("WindowsRestriction")) {
            return null;
        }
        return $this->getProperty("WindowsRestriction");
    }
    /**
     * @var DeviceEnrollmentPlatformRestriction
     */
    public function setWindowsRestriction($value)
    {
        $this->setProperty("WindowsRestriction", $value, true);
    }
    /**
     * @return DeviceEnrollmentPlatformRestriction
     */
    public function getWindowsMobileRestriction()
    {
        if (!$this->isPropertyAvailable("WindowsMobileRestriction")) {
            return null;
        }
        return $this->getProperty("WindowsMobileRestriction");
    }
    /**
     * @var DeviceEnrollmentPlatformRestriction
     */
    public function setWindowsMobileRestriction($value)
    {
        $this->setProperty("WindowsMobileRestriction", $value, true);
    }
    /**
     * @return DeviceEnrollmentPlatformRestriction
     */
    public function getAndroidRestriction()
    {
        if (!$this->isPropertyAvailable("AndroidRestriction")) {
            return null;
        }
        return $this->getProperty("AndroidRestriction");
    }
    /**
     * @var DeviceEnrollmentPlatformRestriction
     */
    public function setAndroidRestriction($value)
    {
        $this->setProperty("AndroidRestriction", $value, true);
    }
    /**
     * @return DeviceEnrollmentPlatformRestriction
     */
    public function getMacOSRestriction()
    {
        if (!$this->isPropertyAvailable("MacOSRestriction")) {
            return null;
        }
        return $this->getProperty("MacOSRestriction");
    }
    /**
     * @var DeviceEnrollmentPlatformRestriction
     */
    public function setMacOSRestriction($value)
    {
        $this->setProperty("MacOSRestriction", $value, true);
    }
}