<?php

/**
 *  2025-08-22T05:41:05+00:00 
 */
namespace Office365\Intune;

use Office365\Entity;
class SharedPCConfiguration extends Entity
{
    /**
     * @return bool
     */
    public function getAllowLocalStorage()
    {
        return $this->getProperty("AllowLocalStorage");
    }
    /**
     * @var bool
     */
    public function setAllowLocalStorage($value)
    {
        return $this->setProperty("AllowLocalStorage", $value, true);
    }
    /**
     * @return bool
     */
    public function getDisableAccountManager()
    {
        return $this->getProperty("DisableAccountManager");
    }
    /**
     * @var bool
     */
    public function setDisableAccountManager($value)
    {
        return $this->setProperty("DisableAccountManager", $value, true);
    }
    /**
     * @return bool
     */
    public function getDisableEduPolicies()
    {
        return $this->getProperty("DisableEduPolicies");
    }
    /**
     * @var bool
     */
    public function setDisableEduPolicies($value)
    {
        return $this->setProperty("DisableEduPolicies", $value, true);
    }
    /**
     * @return bool
     */
    public function getDisablePowerPolicies()
    {
        return $this->getProperty("DisablePowerPolicies");
    }
    /**
     * @var bool
     */
    public function setDisablePowerPolicies($value)
    {
        return $this->setProperty("DisablePowerPolicies", $value, true);
    }
    /**
     * @return bool
     */
    public function getDisableSignInOnResume()
    {
        return $this->getProperty("DisableSignInOnResume");
    }
    /**
     * @var bool
     */
    public function setDisableSignInOnResume($value)
    {
        return $this->setProperty("DisableSignInOnResume", $value, true);
    }
    /**
     * @return bool
     */
    public function getEnabled()
    {
        return $this->getProperty("Enabled");
    }
    /**
     * @var bool
     */
    public function setEnabled($value)
    {
        return $this->setProperty("Enabled", $value, true);
    }
    /**
     * @return integer
     */
    public function getIdleTimeBeforeSleepInSeconds()
    {
        return $this->getProperty("IdleTimeBeforeSleepInSeconds");
    }
    /**
     * @var integer
     */
    public function setIdleTimeBeforeSleepInSeconds($value)
    {
        return $this->setProperty("IdleTimeBeforeSleepInSeconds", $value, true);
    }
    /**
     * @return string
     */
    public function getKioskAppDisplayName()
    {
        return $this->getProperty("KioskAppDisplayName");
    }
    /**
     * @var string
     */
    public function setKioskAppDisplayName($value)
    {
        return $this->setProperty("KioskAppDisplayName", $value, true);
    }
    /**
     * @return string
     */
    public function getKioskAppUserModelId()
    {
        return $this->getProperty("KioskAppUserModelId");
    }
    /**
     * @var string
     */
    public function setKioskAppUserModelId($value)
    {
        return $this->setProperty("KioskAppUserModelId", $value, true);
    }
    /**
     * @return SharedPCAccountManagerPolicy
     */
    public function getAccountManagerPolicy()
    {
        return $this->getProperty("AccountManagerPolicy");
    }
    /**
     * @var SharedPCAccountManagerPolicy
     */
    public function setAccountManagerPolicy($value)
    {
        return $this->setProperty("AccountManagerPolicy", $value, true);
    }
}