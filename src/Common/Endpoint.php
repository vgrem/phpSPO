<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

class Endpoint extends ClientObject
{
    /**
     * @return string
     */
    public function getCapability()
    {
        if (!$this->isPropertyAvailable("Capability")) {
            return null;
        }
        return $this->getProperty("Capability");
    }
    /**
     * @var string
     */
    public function setCapability($value)
    {
        $this->setProperty("Capability", $value, true);
    }
    /**
     * @return string
     */
    public function getProviderId()
    {
        if (!$this->isPropertyAvailable("ProviderId")) {
            return null;
        }
        return $this->getProperty("ProviderId");
    }
    /**
     * @var string
     */
    public function setProviderId($value)
    {
        $this->setProperty("ProviderId", $value, true);
    }
    /**
     * @return string
     */
    public function getProviderName()
    {
        if (!$this->isPropertyAvailable("ProviderName")) {
            return null;
        }
        return $this->getProperty("ProviderName");
    }
    /**
     * @var string
     */
    public function setProviderName($value)
    {
        $this->setProperty("ProviderName", $value, true);
    }
    /**
     * @return string
     */
    public function getUri()
    {
        if (!$this->isPropertyAvailable("Uri")) {
            return null;
        }
        return $this->getProperty("Uri");
    }
    /**
     * @var string
     */
    public function setUri($value)
    {
        $this->setProperty("Uri", $value, true);
    }
    /**
     * @return string
     */
    public function getProviderResourceId()
    {
        if (!$this->isPropertyAvailable("ProviderResourceId")) {
            return null;
        }
        return $this->getProperty("ProviderResourceId");
    }
    /**
     * @var string
     */
    public function setProviderResourceId($value)
    {
        $this->setProperty("ProviderResourceId", $value, true);
    }
}