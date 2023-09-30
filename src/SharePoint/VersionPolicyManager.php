<?php

/**
 * Generated  2023-09-30T09:13:50+00:00 16.0.24106.12014
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientObject;
use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\Actions\UpdateEntityQuery;
class VersionPolicyManager extends BaseEntity
{
    /**
     * @return integer
     */
    public function getDefaultExpireAfterDays()
    {
        return $this->getProperty("DefaultExpireAfterDays");
    }
    /**
     * @var integer
     */
    public function setDefaultExpireAfterDays($value)
    {
        return $this->setProperty("DefaultExpireAfterDays", $value, true);
    }
    /**
     * @return integer
     */
    public function getDefaultTrimMode()
    {
        return $this->getProperty("DefaultTrimMode");
    }
    /**
     * @var integer
     */
    public function setDefaultTrimMode($value)
    {
        return $this->setProperty("DefaultTrimMode", $value, true);
    }
}