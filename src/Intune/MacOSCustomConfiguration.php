<?php

/**
 *  2025-08-22T05:38:57+00:00 
 */
namespace Office365\Intune;

use Office365\Entity;

class MacOSCustomConfiguration extends Entity
{
    /**
     * @return string
     */
    public function getPayloadName()
    {
        return $this->getProperty("PayloadName");
    }
    /**
     * @var string
     */
    public function setPayloadName($value)
    {
        return $this->setProperty("PayloadName", $value, true);
    }
    /**
     * @return string
     */
    public function getPayloadFileName()
    {
        return $this->getProperty("PayloadFileName");
    }
    /**
     * @var string
     */
    public function setPayloadFileName($value)
    {
        return $this->setProperty("PayloadFileName", $value, true);
    }
    /**
     * @return string
     */
    public function getPayload()
    {
        return $this->getProperty("Payload");
    }
    /**
     * @var string
     */
    public function setPayload($value)
    {
        return $this->setProperty("Payload", $value, true);
    }
}