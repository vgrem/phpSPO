<?php

/**
 * Modified: 2020-05-24T22:08:35+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

class DirectoryObjectPartnerReference extends ClientObject
{
    /**
     * @return string
     */
    public function getDescription()
    {
        if (!$this->isPropertyAvailable("Description")) {
            return null;
        }
        return $this->getProperty("Description");
    }
    /**
     * @var string
     */
    public function setDescription($value)
    {
        $this->setProperty("Description", $value, true);
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
     * @return string
     */
    public function getExternalPartnerTenantId()
    {
        if (!$this->isPropertyAvailable("ExternalPartnerTenantId")) {
            return null;
        }
        return $this->getProperty("ExternalPartnerTenantId");
    }
    /**
     * @var string
     */
    public function setExternalPartnerTenantId($value)
    {
        $this->setProperty("ExternalPartnerTenantId", $value, true);
    }
    /**
     * @return string
     */
    public function getObjectType()
    {
        if (!$this->isPropertyAvailable("ObjectType")) {
            return null;
        }
        return $this->getProperty("ObjectType");
    }
    /**
     * @var string
     */
    public function setObjectType($value)
    {
        $this->setProperty("ObjectType", $value, true);
    }
}