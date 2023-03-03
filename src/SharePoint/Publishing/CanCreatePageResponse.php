<?php

/**
 * Generated  2023-01-13T18:22:53+02:00 16.0.23207.12005
 */
namespace Office365\SharePoint\Publishing;

use Office365\Runtime\ClientObject;
use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\Actions\UpdateEntityQuery;
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
}