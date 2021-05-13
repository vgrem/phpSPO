<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Intune;

use Office365\Runtime\ClientObject;

class IosCustomConfiguration extends ClientObject
{
    /**
     * @return string
     */
    public function getPayloadName()
    {
        if (!$this->isPropertyAvailable("PayloadName")) {
            return null;
        }
        return $this->getProperty("PayloadName");
    }
    /**
     * @var string
     */
    public function setPayloadName($value)
    {
        $this->setProperty("PayloadName", $value, true);
    }
    /**
     * @return string
     */
    public function getPayloadFileName()
    {
        if (!$this->isPropertyAvailable("PayloadFileName")) {
            return null;
        }
        return $this->getProperty("PayloadFileName");
    }
    /**
     * @var string
     */
    public function setPayloadFileName($value)
    {
        $this->setProperty("PayloadFileName", $value, true);
    }
    /**
     * @return string
     */
    public function getPayload()
    {
        if (!$this->isPropertyAvailable("Payload")) {
            return null;
        }
        return $this->getProperty("Payload");
    }
    /**
     * @var string
     */
    public function setPayload($value)
    {
        $this->setProperty("Payload", $value, true);
    }
}