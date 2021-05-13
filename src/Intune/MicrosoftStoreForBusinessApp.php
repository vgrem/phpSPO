<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Intune;

use Office365\Runtime\ClientObject;

class MicrosoftStoreForBusinessApp extends ClientObject
{
    /**
     * @return integer
     */
    public function getUsedLicenseCount()
    {
        if (!$this->isPropertyAvailable("UsedLicenseCount")) {
            return null;
        }
        return $this->getProperty("UsedLicenseCount");
    }
    /**
     * @var integer
     */
    public function setUsedLicenseCount($value)
    {
        $this->setProperty("UsedLicenseCount", $value, true);
    }
    /**
     * @return integer
     */
    public function getTotalLicenseCount()
    {
        if (!$this->isPropertyAvailable("TotalLicenseCount")) {
            return null;
        }
        return $this->getProperty("TotalLicenseCount");
    }
    /**
     * @var integer
     */
    public function setTotalLicenseCount($value)
    {
        $this->setProperty("TotalLicenseCount", $value, true);
    }
    /**
     * @return string
     */
    public function getProductKey()
    {
        if (!$this->isPropertyAvailable("ProductKey")) {
            return null;
        }
        return $this->getProperty("ProductKey");
    }
    /**
     * @var string
     */
    public function setProductKey($value)
    {
        $this->setProperty("ProductKey", $value, true);
    }
    /**
     * @return string
     */
    public function getPackageIdentityName()
    {
        if (!$this->isPropertyAvailable("PackageIdentityName")) {
            return null;
        }
        return $this->getProperty("PackageIdentityName");
    }
    /**
     * @var string
     */
    public function setPackageIdentityName($value)
    {
        $this->setProperty("PackageIdentityName", $value, true);
    }
}