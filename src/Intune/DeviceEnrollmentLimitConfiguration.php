<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Intune;

use Office365\Entity;

class DeviceEnrollmentLimitConfiguration extends Entity
{
    /**
     * @return integer
     */
    public function getLimit()
    {
        if (!$this->isPropertyAvailable("Limit")) {
            return null;
        }
        return $this->getProperty("Limit");
    }
    /**
     * @var integer
     */
    public function setLimit($value)
    {
        $this->setProperty("Limit", $value, true);
    }
}