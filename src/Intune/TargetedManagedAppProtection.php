<?php

/**
 *  2025-08-21T20:52:59+00:00 
 */
namespace Office365\Intune;

use Office365\Entity;

class TargetedManagedAppProtection extends Entity
{
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