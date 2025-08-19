<?php

/**
 * Generated  2025-08-19T15:30:13+00:00 16.0.26330.12013
 */
namespace Office365\SharePoint\Publishing;


use Office365\SharePoint\BaseEntity;

class ApprovalRequestSyncResponse extends BaseEntity
{
    /**
     * @return string
     */
    public function getApprovalRequest()
    {
        return $this->getProperty("ApprovalRequest");
    }
    /**
     * @var string
     */
    public function setApprovalRequest($value)
    {
        return $this->setProperty("ApprovalRequest", $value, true);
    }
    /**
     * @return integer
     */
    public function getPublicationStatus()
    {
        return $this->getProperty("PublicationStatus");
    }
    /**
     * @var integer
     */
    public function setPublicationStatus($value)
    {
        return $this->setProperty("PublicationStatus", $value, true);
    }
}