<?php

/**
 *  2025-08-21T20:52:59+00:00 
 */
namespace Office365\Intune;

use Office365\Entity;

class TargetedManagedAppConfiguration extends Entity
{
    /**
     * @return integer
     */
    public function getDeployedAppCount()
    {
        return $this->getProperty("DeployedAppCount");
    }
    /**
     * @var integer
     */
    public function setDeployedAppCount($value)
    {
        return $this->setProperty("DeployedAppCount", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsAssigned()
    {
        return $this->getProperty("IsAssigned");
    }
    /**
     * @var bool
     */
    public function setIsAssigned($value)
    {
        return $this->setProperty("IsAssigned", $value, true);
    }
}