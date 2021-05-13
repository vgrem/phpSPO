<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\Common;


use Office365\Entity;

/**
 * Represents a tenant's secure score per day of scoring data, at the tenant and control level. By default, 90 days of data is held. This data is sorted by **createdDateTime**, from latest to earliest. This will allow you to page responses by using $top=n, where n = the number of days of data that you want to retrieve. 
 */
class SecureScore extends Entity
{
    /**
     * @return integer
     */
    public function getActiveUserCount()
    {
        return $this->getProperty("ActiveUserCount");
    }
    /**
     * @var integer
     */
    public function setActiveUserCount($value)
    {
        $this->setProperty("ActiveUserCount", $value, true);
    }
    /**
     * @return string
     */
    public function getAzureTenantId()
    {
        return $this->getProperty("AzureTenantId");
    }
    /**
     * @var string
     */
    public function setAzureTenantId($value)
    {
        $this->setProperty("AzureTenantId", $value, true);
    }
    /**
     * @return double
     */
    public function getCurrentScore()
    {
        return $this->getProperty("CurrentScore");
    }
    /**
     * @var double
     */
    public function setCurrentScore($value)
    {
        $this->setProperty("CurrentScore", $value, true);
    }
    /**
     * @return array
     */
    public function getEnabledServices()
    {
        return $this->getProperty("EnabledServices");
    }
    /**
     * @var array
     */
    public function setEnabledServices($value)
    {
        $this->setProperty("EnabledServices", $value, true);
    }
    /**
     * @return integer
     */
    public function getLicensedUserCount()
    {
        return $this->getProperty("LicensedUserCount");
    }
    /**
     * @var integer
     */
    public function setLicensedUserCount($value)
    {
        $this->setProperty("LicensedUserCount", $value, true);
    }
    /**
     * @return double
     */
    public function getMaxScore()
    {
        return $this->getProperty("MaxScore");
    }
    /**
     * @var double
     */
    public function setMaxScore($value)
    {
        $this->setProperty("MaxScore", $value, true);
    }
    /**
     * @return SecurityVendorInformation
     */
    public function getVendorInformation()
    {
        return $this->getProperty("VendorInformation");
    }
    /**
     * @var SecurityVendorInformation
     */
    public function setVendorInformation($value)
    {
        $this->setProperty("VendorInformation", $value, true);
    }
}