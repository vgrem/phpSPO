<?php

/**
 * Generated  2025-08-24T07:40:13+00:00 16.0.26406.12014
 */
namespace Office365\SharePoint\CompliancePolicy;

use Office365\Runtime\ClientObject;
use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\Actions\UpdateEntityQuery;
use Office365\SharePoint\BaseEntity;

class SPPolicyStoreProxy extends BaseEntity
{
    /**
     * @return string
     */
    public function getPolicyStoreUrl()
    {
        return $this->getProperty("PolicyStoreUrl");
    }
    /**
     * @var string
     */
    public function setPolicyStoreUrl($value)
    {
        return $this->setProperty("PolicyStoreUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getReviewCenterUrl()
    {
        return $this->getProperty("ReviewCenterUrl");
    }
    /**
     * @var string
     */
    public function setReviewCenterUrl($value)
    {
        return $this->setProperty("ReviewCenterUrl", $value, true);
    }
    /**
     * @return bool
     */
    public function getSupportContentTypeRetention()
    {
        return $this->getProperty("SupportContentTypeRetention");
    }
    /**
     * @var bool
     */
    public function setSupportContentTypeRetention($value)
    {
        return $this->setProperty("SupportContentTypeRetention", $value, true);
    }
}