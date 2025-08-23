<?php

/**
 *  2025-08-22T05:38:57+00:00 
 */
namespace Office365\Intune;

use Office365\Entity;

class MacOSCompliancePolicy extends Entity
{
    /**
     * @return bool
     */
    public function getPasswordRequired()
    {
        return $this->getProperty("PasswordRequired");
    }
    /**
     * @var bool
     */
    public function setPasswordRequired($value)
    {
        return $this->setProperty("PasswordRequired", $value, true);
    }
    /**
     * @return bool
     */
    public function getPasswordBlockSimple()
    {
        return $this->getProperty("PasswordBlockSimple");
    }
    /**
     * @var bool
     */
    public function setPasswordBlockSimple($value)
    {
        return $this->setProperty("PasswordBlockSimple", $value, true);
    }
    /**
     * @return integer
     */
    public function getPasswordExpirationDays()
    {
        return $this->getProperty("PasswordExpirationDays");
    }
    /**
     * @var integer
     */
    public function setPasswordExpirationDays($value)
    {
        return $this->setProperty("PasswordExpirationDays", $value, true);
    }
    /**
     * @return integer
     */
    public function getPasswordMinimumLength()
    {
        return $this->getProperty("PasswordMinimumLength");
    }
    /**
     * @var integer
     */
    public function setPasswordMinimumLength($value)
    {
        return $this->setProperty("PasswordMinimumLength", $value, true);
    }
    /**
     * @return integer
     */
    public function getPasswordMinutesOfInactivityBeforeLock()
    {
        return $this->getProperty("PasswordMinutesOfInactivityBeforeLock");
    }
    /**
     * @var integer
     */
    public function setPasswordMinutesOfInactivityBeforeLock($value)
    {
        return $this->setProperty("PasswordMinutesOfInactivityBeforeLock", $value, true);
    }
    /**
     * @return integer
     */
    public function getPasswordPreviousPasswordBlockCount()
    {
        return $this->getProperty("PasswordPreviousPasswordBlockCount");
    }
    /**
     * @var integer
     */
    public function setPasswordPreviousPasswordBlockCount($value)
    {
        return $this->setProperty("PasswordPreviousPasswordBlockCount", $value, true);
    }
    /**
     * @return integer
     */
    public function getPasswordMinimumCharacterSetCount()
    {
        return $this->getProperty("PasswordMinimumCharacterSetCount");
    }
    /**
     * @var integer
     */
    public function setPasswordMinimumCharacterSetCount($value)
    {
        return $this->setProperty("PasswordMinimumCharacterSetCount", $value, true);
    }
    /**
     * @return string
     */
    public function getOsMinimumVersion()
    {
        return $this->getProperty("OsMinimumVersion");
    }
    /**
     * @var string
     */
    public function setOsMinimumVersion($value)
    {
        return $this->setProperty("OsMinimumVersion", $value, true);
    }
    /**
     * @return string
     */
    public function getOsMaximumVersion()
    {
        return $this->getProperty("OsMaximumVersion");
    }
    /**
     * @var string
     */
    public function setOsMaximumVersion($value)
    {
        return $this->setProperty("OsMaximumVersion", $value, true);
    }
    /**
     * @return bool
     */
    public function getSystemIntegrityProtectionEnabled()
    {
        return $this->getProperty("SystemIntegrityProtectionEnabled");
    }
    /**
     * @var bool
     */
    public function setSystemIntegrityProtectionEnabled($value)
    {
        return $this->setProperty("SystemIntegrityProtectionEnabled", $value, true);
    }
    /**
     * @return bool
     */
    public function getDeviceThreatProtectionEnabled()
    {
        return $this->getProperty("DeviceThreatProtectionEnabled");
    }
    /**
     * @var bool
     */
    public function setDeviceThreatProtectionEnabled($value)
    {
        return $this->setProperty("DeviceThreatProtectionEnabled", $value, true);
    }
    /**
     * @return bool
     */
    public function getStorageRequireEncryption()
    {
        return $this->getProperty("StorageRequireEncryption");
    }
    /**
     * @var bool
     */
    public function setStorageRequireEncryption($value)
    {
        return $this->setProperty("StorageRequireEncryption", $value, true);
    }
    /**
     * @return bool
     */
    public function getFirewallEnabled()
    {
        return $this->getProperty("FirewallEnabled");
    }
    /**
     * @var bool
     */
    public function setFirewallEnabled($value)
    {
        return $this->setProperty("FirewallEnabled", $value, true);
    }
    /**
     * @return bool
     */
    public function getFirewallBlockAllIncoming()
    {
        return $this->getProperty("FirewallBlockAllIncoming");
    }
    /**
     * @var bool
     */
    public function setFirewallBlockAllIncoming($value)
    {
        return $this->setProperty("FirewallBlockAllIncoming", $value, true);
    }
    /**
     * @return bool
     */
    public function getFirewallEnableStealthMode()
    {
        return $this->getProperty("FirewallEnableStealthMode");
    }
    /**
     * @var bool
     */
    public function setFirewallEnableStealthMode($value)
    {
        return $this->setProperty("FirewallEnableStealthMode", $value, true);
    }
}