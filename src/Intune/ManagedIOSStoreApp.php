<?php

/**
 *  2025-08-22T05:37:38+00:00 
 */
namespace Office365\Intune;

use Office365\Entity;

class ManagedIOSStoreApp extends Entity
{
    /**
     * @return string
     */
    public function getBundleId()
    {
        return $this->getProperty("BundleId");
    }
    /**
     * @var string
     */
    public function setBundleId($value)
    {
        return $this->setProperty("BundleId", $value, true);
    }
    /**
     * @return string
     */
    public function getAppStoreUrl()
    {
        return $this->getProperty("AppStoreUrl");
    }
    /**
     * @var string
     */
    public function setAppStoreUrl($value)
    {
        return $this->setProperty("AppStoreUrl", $value, true);
    }
}