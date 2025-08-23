<?php

/**
 *  2025-08-22T05:37:38+00:00 
 */
namespace Office365\Intune;

use Office365\Entity;

class MicrosoftStoreForBusinessApp extends Entity
{
    /**
     * @return integer
     */
    public function getUsedLicenseCount()
    {
        return $this->getProperty("UsedLicenseCount");
    }
    /**
     * @var integer
     */
    public function setUsedLicenseCount($value)
    {
        return $this->setProperty("UsedLicenseCount", $value, true);
    }
    /**
     * @return integer
     */
    public function getTotalLicenseCount()
    {
        return $this->getProperty("TotalLicenseCount");
    }
    /**
     * @var integer
     */
    public function setTotalLicenseCount($value)
    {
        return $this->setProperty("TotalLicenseCount", $value, true);
    }
    /**
     * @return string
     */
    public function getProductKey()
    {
        return $this->getProperty("ProductKey");
    }
    /**
     * @var string
     */
    public function setProductKey($value)
    {
        return $this->setProperty("ProductKey", $value, true);
    }
    /**
     * @return string
     */
    public function getPackageIdentityName()
    {
        return $this->getProperty("PackageIdentityName");
    }
    /**
     * @var string
     */
    public function setPackageIdentityName($value)
    {
        return $this->setProperty("PackageIdentityName", $value, true);
    }
}