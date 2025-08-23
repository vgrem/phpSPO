<?php

/**
 *  2025-08-22T05:37:38+00:00 
 */
namespace Office365\Intune;

use Office365\Entity;

class ManagedIOSLobApp extends Entity
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
    public function getVersionNumber()
    {
        return $this->getProperty("VersionNumber");
    }
    /**
     * @var string
     */
    public function setVersionNumber($value)
    {
        return $this->setProperty("VersionNumber", $value, true);
    }
    /**
     * @return string
     */
    public function getBuildNumber()
    {
        return $this->getProperty("BuildNumber");
    }
    /**
     * @var string
     */
    public function setBuildNumber($value)
    {
        return $this->setProperty("BuildNumber", $value, true);
    }
}