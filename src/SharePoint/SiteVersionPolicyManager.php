<?php

/**
 * Generated  2023-10-01T08:17:31+00:00 16.0.24106.12014
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
    /**
     * @return VersionPolicyManager
     */
    public function getVersionPolicies()
    {
        return $this->getProperty("VersionPolicies", new VersionPolicyManager($this->getContext(), new ResourcePath("VersionPolicies", $this->getResourcePath())));
    }
}