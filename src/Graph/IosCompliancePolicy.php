<?php

/**
 * Generated by phpSPO model generator 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Graph;

use Office365\Runtime\ClientObject;
use Office365\Runtime\ResourcePath;
class IosCompliancePolicy extends ClientObject
{
    /**
     * @return bool
     */
    public function getPasscodeBlockSimple()
    {
        if (!$this->isPropertyAvailable("PasscodeBlockSimple")) {
            return null;
        }
        return $this->getProperty("PasscodeBlockSimple");
    }
    /**
     * @var bool
     */
    public function setPasscodeBlockSimple($value)
    {
        $this->setProperty("PasscodeBlockSimple", $value, true);
    }
    /**
     * @return integer
     */
    public function getPasscodeExpirationDays()
    {
        if (!$this->isPropertyAvailable("PasscodeExpirationDays")) {
            return null;
        }
        return $this->getProperty("PasscodeExpirationDays");
    }
    /**
     * @var integer
     */
    public function setPasscodeExpirationDays($value)
    {
        $this->setProperty("PasscodeExpirationDays", $value, true);
    }
    /**
     * @return integer
     */
    public function getPasscodeMinimumLength()
    {
        if (!$this->isPropertyAvailable("PasscodeMinimumLength")) {
            return null;
        }
        return $this->getProperty("PasscodeMinimumLength");
    }
    /**
     * @var integer
     */
    public function setPasscodeMinimumLength($value)
    {
        $this->setProperty("PasscodeMinimumLength", $value, true);
    }
    /**
     * @return integer
     */
    public function getPasscodeMinutesOfInactivityBeforeLock()
    {
        if (!$this->isPropertyAvailable("PasscodeMinutesOfInactivityBeforeLock")) {
            return null;
        }
        return $this->getProperty("PasscodeMinutesOfInactivityBeforeLock");
    }
    /**
     * @var integer
     */
    public function setPasscodeMinutesOfInactivityBeforeLock($value)
    {
        $this->setProperty("PasscodeMinutesOfInactivityBeforeLock", $value, true);
    }
    /**
     * @return integer
     */
    public function getPasscodePreviousPasscodeBlockCount()
    {
        if (!$this->isPropertyAvailable("PasscodePreviousPasscodeBlockCount")) {
            return null;
        }
        return $this->getProperty("PasscodePreviousPasscodeBlockCount");
    }
    /**
     * @var integer
     */
    public function setPasscodePreviousPasscodeBlockCount($value)
    {
        $this->setProperty("PasscodePreviousPasscodeBlockCount", $value, true);
    }
    /**
     * @return integer
     */
    public function getPasscodeMinimumCharacterSetCount()
    {
        if (!$this->isPropertyAvailable("PasscodeMinimumCharacterSetCount")) {
            return null;
        }
        return $this->getProperty("PasscodeMinimumCharacterSetCount");
    }
    /**
     * @var integer
     */
    public function setPasscodeMinimumCharacterSetCount($value)
    {
        $this->setProperty("PasscodeMinimumCharacterSetCount", $value, true);
    }
    /**
     * @return bool
     */
    public function getPasscodeRequired()
    {
        if (!$this->isPropertyAvailable("PasscodeRequired")) {
            return null;
        }
        return $this->getProperty("PasscodeRequired");
    }
    /**
     * @var bool
     */
    public function setPasscodeRequired($value)
    {
        $this->setProperty("PasscodeRequired", $value, true);
    }
    /**
     * @return string
     */
    public function getOsMinimumVersion()
    {
        if (!$this->isPropertyAvailable("OsMinimumVersion")) {
            return null;
        }
        return $this->getProperty("OsMinimumVersion");
    }
    /**
     * @var string
     */
    public function setOsMinimumVersion($value)
    {
        $this->setProperty("OsMinimumVersion", $value, true);
    }
    /**
     * @return string
     */
    public function getOsMaximumVersion()
    {
        if (!$this->isPropertyAvailable("OsMaximumVersion")) {
            return null;
        }
        return $this->getProperty("OsMaximumVersion");
    }
    /**
     * @var string
     */
    public function setOsMaximumVersion($value)
    {
        $this->setProperty("OsMaximumVersion", $value, true);
    }
    /**
     * @return bool
     */
    public function getSecurityBlockJailbrokenDevices()
    {
        if (!$this->isPropertyAvailable("SecurityBlockJailbrokenDevices")) {
            return null;
        }
        return $this->getProperty("SecurityBlockJailbrokenDevices");
    }
    /**
     * @var bool
     */
    public function setSecurityBlockJailbrokenDevices($value)
    {
        $this->setProperty("SecurityBlockJailbrokenDevices", $value, true);
    }
    /**
     * @return bool
     */
    public function getDeviceThreatProtectionEnabled()
    {
        if (!$this->isPropertyAvailable("DeviceThreatProtectionEnabled")) {
            return null;
        }
        return $this->getProperty("DeviceThreatProtectionEnabled");
    }
    /**
     * @var bool
     */
    public function setDeviceThreatProtectionEnabled($value)
    {
        $this->setProperty("DeviceThreatProtectionEnabled", $value, true);
    }
    /**
     * @return bool
     */
    public function getManagedEmailProfileRequired()
    {
        if (!$this->isPropertyAvailable("ManagedEmailProfileRequired")) {
            return null;
        }
        return $this->getProperty("ManagedEmailProfileRequired");
    }
    /**
     * @var bool
     */
    public function setManagedEmailProfileRequired($value)
    {
        $this->setProperty("ManagedEmailProfileRequired", $value, true);
    }
}