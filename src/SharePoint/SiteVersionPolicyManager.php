<?php

/**
 * Generated  2023-09-30T09:13:50+00:00 16.0.24106.12014
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientObject;
use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\Actions\UpdateEntityQuery;
class SiteVersionPolicyManager extends BaseEntity
{
    /**
     * @return integer
     */
    public function getMajorVersionLimit()
    {
        return $this->getProperty("MajorVersionLimit");
    }
    /**
     * @var integer
     */
    public function setMajorVersionLimit($value)
    {
        return $this->setProperty("MajorVersionLimit", $value, true);
    }
}