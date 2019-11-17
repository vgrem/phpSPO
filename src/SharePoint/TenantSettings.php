<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T18:22:48+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
/**
 * Specifies 
 * the tenant properties.
 */
class TenantSettings extends ClientObject
{
    /**
     * @return string
     */
    public function getCorporateCatalogUrl()
    {
        if (!$this->isPropertyAvailable("CorporateCatalogUrl")) {
            return null;
        }
        return $this->getProperty("CorporateCatalogUrl");
    }
    /**
     * @var string
     */
    public function setCorporateCatalogUrl($value)
    {
        $this->setProperty("CorporateCatalogUrl", $value, true);
    }
    /**
     * @return TenantSettings
     */
    public function getCurrent()
    {
        if (!$this->isPropertyAvailable("Current")) {
            $this->setProperty("Current", new TenantSettings($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "Current")));
        }
        return $this->getProperty("Current");
    }
}