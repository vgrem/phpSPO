<?php

/**
 * Generated  2025-06-14T08:50:37+00:00 16.0.26121.12017
 */
namespace Office365\SharePoint\UserProfiles;

use Office365\SharePoint\BaseEntity;
class PersonalCache extends BaseEntity
{
    /**
     * @return string
     */
    public function getMySiteUrl()
    {
        return $this->getProperty("MySiteUrl");
    }
    /**
     * @var string
     */
    public function setMySiteUrl($value)
    {
        $this->setProperty("MySiteUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getCacheName()
    {
        return $this->getProperty("CacheName");
    }
    /**
     * @var string
     */
    public function setCacheName($value)
    {
        return $this->setProperty("CacheName", $value, true);
    }
    /**
     * @return bool
     */
    public function getRequireHtmlStorage()
    {
        return $this->getProperty("RequireHtmlStorage");
    }
    /**
     * @var bool
     */
    public function setRequireHtmlStorage($value)
    {
        return $this->setProperty("RequireHtmlStorage", $value, true);
    }
}