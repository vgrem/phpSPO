<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00
 */
namespace Office365\Intune;

use Office365\Runtime\ClientObject;

class TargetedManagedAppProtection extends ClientObject
{
    /**
     * @return bool
     */
    public function getIsAssigned()
    {
        if (!$this->isPropertyAvailable("IsAssigned")) {
            return null;
        }
        return $this->getProperty("IsAssigned");
    }
    /**
     * @var bool
     */
    public function setIsAssigned($value)
    {
        $this->setProperty("IsAssigned", $value, true);
    }
}