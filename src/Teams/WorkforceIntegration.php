<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\Teams;

use Office365\Entity;
/**
 * An instance of a workforce integration with shifts.
 */
class WorkforceIntegration extends Entity
{
    /**
     * Name of the workforce integration.
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
     * Name of the workforce integration.
     * @var string
     */
    public function setDisplayName($value)
    {
        $this->setProperty("DisplayName", $value, true);
    }
    /**
     * API version for the call back URL. Start with 1.
     * @return integer
     */
    public function getApiVersion()
    {
        if (!$this->isPropertyAvailable("ApiVersion")) {
            return null;
        }
        return $this->getProperty("ApiVersion");
    }
    /**
     * API version for the call back URL. Start with 1.
     * @var integer
     */
    public function setApiVersion($value)
    {
        $this->setProperty("ApiVersion", $value, true);
    }
    /**
     * Indicates whether this workforce integration is currently active and available.
     * @return bool
     */
    public function getIsActive()
    {
        if (!$this->isPropertyAvailable("IsActive")) {
            return null;
        }
        return $this->getProperty("IsActive");
    }
    /**
     * Indicates whether this workforce integration is currently active and available.
     * @var bool
     */
    public function setIsActive($value)
    {
        $this->setProperty("IsActive", $value, true);
    }
    /**
     *  Workforce Integration URL for callbacks from the Shifts service.
     * @return string
     */
    public function getUrl()
    {
        if (!$this->isPropertyAvailable("Url")) {
            return null;
        }
        return $this->getProperty("Url");
    }
    /**
     *  Workforce Integration URL for callbacks from the Shifts service.
     * @var string
     */
    public function setUrl($value)
    {
        $this->setProperty("Url", $value, true);
    }
}