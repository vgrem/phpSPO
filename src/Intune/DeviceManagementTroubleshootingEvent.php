<?php

/**
 * Modified: 2020-05-24T22:08:35+00:00
 */
namespace Office365\Intune;

use Office365\Entity;


class DeviceManagementTroubleshootingEvent extends Entity
{
    /**
     * @return string
     */
    public function getCorrelationId()
    {
        if (!$this->isPropertyAvailable("CorrelationId")) {
            return null;
        }
        return $this->getProperty("CorrelationId");
    }
    /**
     * @var string
     */
    public function setCorrelationId($value)
    {
        $this->setProperty("CorrelationId", $value, true);
    }
}