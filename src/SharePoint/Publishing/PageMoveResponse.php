<?php

/**
 * Generated  2025-08-18T13:04:30+00:00 16.0.26330.12013
 */
namespace Office365\SharePoint\Publishing;


use Office365\SharePoint\BaseEntity;

class PageMoveResponse extends BaseEntity
{
    /**
     * @return array
     */
    public function getCompletedAssets()
    {
        return $this->getProperty("CompletedAssets");
    }
    /**
     * @var array
     */
    public function setCompletedAssets($value)
    {
        return $this->setProperty("CompletedAssets", $value, true);
    }
    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->getProperty("ErrorMessage");
    }
    /**
     * @var string
     */
    public function setErrorMessage($value)
    {
        return $this->setProperty("ErrorMessage", $value, true);
    }
    /**
     * @return integer
     */
    public function getErrorType()
    {
        return $this->getProperty("ErrorType");
    }
    /**
     * @var integer
     */
    public function setErrorType($value)
    {
        return $this->setProperty("ErrorType", $value, true);
    }
    /**
     * @return integer
     */
    public function getJobState()
    {
        return $this->getProperty("JobState");
    }
    /**
     * @var integer
     */
    public function setJobState($value)
    {
        return $this->setProperty("JobState", $value, true);
    }
    /**
     * @return integer
     */
    public function getNewPageId()
    {
        return $this->getProperty("NewPageId");
    }
    /**
     * @var integer
     */
    public function setNewPageId($value)
    {
        return $this->setProperty("NewPageId", $value, true);
    }
    /**
     * @return string
     */
    public function getNewPageUniqueId()
    {
        return $this->getProperty("NewPageUniqueId");
    }
    /**
     * @var string
     */
    public function setNewPageUniqueId($value)
    {
        return $this->setProperty("NewPageUniqueId", $value, true);
    }
    /**
     * @return string
     */
    public function getNewPageUrl()
    {
        return $this->getProperty("NewPageUrl");
    }
    /**
     * @var string
     */
    public function setNewPageUrl($value)
    {
        return $this->setProperty("NewPageUrl", $value, true);
    }
    /**
     * @return integer
     */
    public function getTotalAssetsToMove()
    {
        return $this->getProperty("TotalAssetsToMove");
    }
    /**
     * @var integer
     */
    public function setTotalAssetsToMove($value)
    {
        return $this->setProperty("TotalAssetsToMove", $value, true);
    }
    /**
     * @return string
     */
    public function getWorkItemId()
    {
        return $this->getProperty("WorkItemId");
    }
    /**
     * @var string
     */
    public function setWorkItemId($value)
    {
        return $this->setProperty("WorkItemId", $value, true);
    }
}