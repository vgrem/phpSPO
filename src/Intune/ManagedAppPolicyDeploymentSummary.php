<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Intune;

use Office365\Runtime\ClientObject;

class ManagedAppPolicyDeploymentSummary extends ClientObject
{
    /**
     * @return string
     */
    public function getDisplayName()
    {
        if (!$this->isPropertyAvailable("DisplayName")) {
            return null;
        }
        return $this->getProperty("DisplayName");
    }
    /**
     * @var string
     */
    public function setDisplayName($value)
    {
        $this->setProperty("DisplayName", $value, true);
    }
    /**
     * @return integer
     */
    public function getConfigurationDeployedUserCount()
    {
        if (!$this->isPropertyAvailable("ConfigurationDeployedUserCount")) {
            return null;
        }
        return $this->getProperty("ConfigurationDeployedUserCount");
    }
    /**
     * @var integer
     */
    public function setConfigurationDeployedUserCount($value)
    {
        $this->setProperty("ConfigurationDeployedUserCount", $value, true);
    }
    /**
     * @return string
     */
    public function getVersion()
    {
        if (!$this->isPropertyAvailable("Version")) {
            return null;
        }
        return $this->getProperty("Version");
    }
    /**
     * @var string
     */
    public function setVersion($value)
    {
        $this->setProperty("Version", $value, true);
    }
}