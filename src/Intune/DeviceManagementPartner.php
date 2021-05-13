<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Intune;

use Office365\Runtime\ClientObject;

class DeviceManagementPartner extends ClientObject
{
    /**
     * @return string
     */
    public function getSingleTenantAppId()
    {
        if (!$this->isPropertyAvailable("SingleTenantAppId")) {
            return null;
        }
        return $this->getProperty("SingleTenantAppId");
    }
    /**
     * @var string
     */
    public function setSingleTenantAppId($value)
    {
        $this->setProperty("SingleTenantAppId", $value, true);
    }
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
     * @return bool
     */
    public function getIsConfigured()
    {
        if (!$this->isPropertyAvailable("IsConfigured")) {
            return null;
        }
        return $this->getProperty("IsConfigured");
    }
    /**
     * @var bool
     */
    public function setIsConfigured($value)
    {
        $this->setProperty("IsConfigured", $value, true);
    }
}