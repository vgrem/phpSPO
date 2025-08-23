<?php

/**
 *  2025-08-22T05:38:57+00:00 
 */
namespace Office365\Intune;

use Office365\Entity;

class MobileThreatDefenseConnector extends Entity
{
    /**
     * @return bool
     */
    public function getAndroidEnabled()
    {
        return $this->getProperty("AndroidEnabled");
    }
    /**
     * @var bool
     */
    public function setAndroidEnabled($value)
    {
        return $this->setProperty("AndroidEnabled", $value, true);
    }
    /**
     * @return bool
     */
    public function getIosEnabled()
    {
        return $this->getProperty("IosEnabled");
    }
    /**
     * @var bool
     */
    public function setIosEnabled($value)
    {
        return $this->setProperty("IosEnabled", $value, true);
    }
    /**
     * @return bool
     */
    public function getAndroidDeviceBlockedOnMissingPartnerData()
    {
        return $this->getProperty("AndroidDeviceBlockedOnMissingPartnerData");
    }
    /**
     * @var bool
     */
    public function setAndroidDeviceBlockedOnMissingPartnerData($value)
    {
        return $this->setProperty("AndroidDeviceBlockedOnMissingPartnerData", $value, true);
    }
    /**
     * @return bool
     */
    public function getIosDeviceBlockedOnMissingPartnerData()
    {
        return $this->getProperty("IosDeviceBlockedOnMissingPartnerData");
    }
    /**
     * @var bool
     */
    public function setIosDeviceBlockedOnMissingPartnerData($value)
    {
        return $this->setProperty("IosDeviceBlockedOnMissingPartnerData", $value, true);
    }
    /**
     * @return bool
     */
    public function getPartnerUnsupportedOsVersionBlocked()
    {
        return $this->getProperty("PartnerUnsupportedOsVersionBlocked");
    }
    /**
     * @var bool
     */
    public function setPartnerUnsupportedOsVersionBlocked($value)
    {
        return $this->setProperty("PartnerUnsupportedOsVersionBlocked", $value, true);
    }
    /**
     * @return integer
     */
    public function getPartnerUnresponsivenessThresholdInDays()
    {
        return $this->getProperty("PartnerUnresponsivenessThresholdInDays");
    }
    /**
     * @var integer
     */
    public function setPartnerUnresponsivenessThresholdInDays($value)
    {
        return $this->setProperty("PartnerUnresponsivenessThresholdInDays", $value, true);
    }
}