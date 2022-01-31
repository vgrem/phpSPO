<?php

/**
 * Generated 2021-10-09T13:33:47+03:00 16.0.21729.12001
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
}