<?php

/**
 * Generated  2025-06-14T08:50:37+00:00 16.0.26121.12017
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientObject;
use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\Actions\UpdateEntityQuery;
class TeamSiteData extends BaseEntity
{
    /**
     * @return integer
     */
    public function getErrorTag()
    {
        return $this->getProperty("ErrorTag");
    }
    /**
     * @var integer
     */
    public function setErrorTag($value)
    {
        return $this->setProperty("ErrorTag", $value, true);
    }
    /**
     * @return integer
     */
    public function getHeaderEmphasis()
    {
        return $this->getProperty("HeaderEmphasis");
    }
    /**
     * @var integer
     */
    public function setHeaderEmphasis($value)
    {
        return $this->setProperty("HeaderEmphasis", $value, true);
    }
    /**
     * @return string
     */
    public function getHubSiteId()
    {
        return $this->getProperty("HubSiteId");
    }
    /**
     * @var string
     */
    public function setHubSiteId($value)
    {
        return $this->setProperty("HubSiteId", $value, true);
    }
    /**
     * @return string
     */
    public function getSiteUrl()
    {
        return $this->getProperty("SiteUrl");
    }
    /**
     * @var string
     */
    public function setSiteUrl($value)
    {
        return $this->setProperty("SiteUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getTenantInstanceId()
    {
        return $this->getProperty("TenantInstanceId");
    }
    /**
     * @var string
     */
    public function setTenantInstanceId($value)
    {
        return $this->setProperty("TenantInstanceId", $value, true);
    }
    /**
     * @return string
     */
    public function getThemeToken()
    {
        return $this->getProperty("ThemeToken");
    }
    /**
     * @var string
     */
    public function setThemeToken($value)
    {
        return $this->setProperty("ThemeToken", $value, true);
    }
    /**
     * @return integer
     */
    public function getHeaderColorIndexInDarkMode()
    {
        return $this->getProperty("HeaderColorIndexInDarkMode");
    }
    /**
     * @var integer
     */
    public function setHeaderColorIndexInDarkMode($value)
    {
        return $this->setProperty("HeaderColorIndexInDarkMode", $value, true);
    }
    /**
     * @return integer
     */
    public function getHeaderColorIndexInLightMode()
    {
        return $this->getProperty("HeaderColorIndexInLightMode");
    }
    /**
     * @var integer
     */
    public function setHeaderColorIndexInLightMode($value)
    {
        return $this->setProperty("HeaderColorIndexInLightMode", $value, true);
    }
}