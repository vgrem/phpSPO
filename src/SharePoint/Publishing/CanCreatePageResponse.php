<?php

/**
 * Generated  2023-09-30T09:13:50+00:00 16.0.24106.12014
 */
namespace Office365\SharePoint\Publishing;

use Office365\SharePoint\BaseEntity;
class CanCreatePageResponse extends BaseEntity
{
    /**
     * @return bool
     */
    public function getCanCreatePage()
    {
        return $this->getProperty("CanCreatePage");
    }
    /**
     * @var bool
     */
    public function setCanCreatePage($value)
    {
        return $this->setProperty("CanCreatePage", $value, true);
    }
    /**
     * @return bool
     */
    public function getCanCreatePromotedPage()
    {
        return $this->getProperty("CanCreatePromotedPage");
    }
    /**
     * @var bool
     */
    public function setCanCreatePromotedPage($value)
    {
        return $this->setProperty("CanCreatePromotedPage", $value, true);
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
     * @return bool
     */
    public function getEnableModeration()
    {
        return $this->getProperty("EnableModeration");
    }
    /**
     * @var bool
     */
    public function setEnableModeration($value)
    {
        return $this->setProperty("EnableModeration", $value, true);
    }
}