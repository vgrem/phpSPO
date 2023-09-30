<?php

/**
 * Generated  2023-09-30T09:13:50+00:00 16.0.24106.12014
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;
class ApprovalRequest extends ClientValue
{
    /**
     * @var string
     */
    public $Id;
    /**
     * @var integer
     */
    public $Status;
    /**
     * @var string
     */
    public $Title;
    /**
     * @return bool
     */
    public function getAllowCancel()
    {
        return $this->getProperty("AllowCancel");
    }
    /**
     * @var bool
     */
    public function setAllowCancel($value)
    {
        return $this->setProperty("AllowCancel", $value, true);
    }
    /**
     * @return bool
     */
    public function getAllowRespond()
    {
        return $this->getProperty("AllowRespond");
    }
    /**
     * @var bool
     */
    public function setAllowRespond($value)
    {
        return $this->setProperty("AllowRespond", $value, true);
    }
    /**
     * @return bool
     */
    public function getAwaitAll()
    {
        return $this->getProperty("AwaitAll");
    }
    /**
     * @var bool
     */
    public function setAwaitAll($value)
    {
        return $this->setProperty("AwaitAll", $value, true);
    }
    /**
     * @return string
     */
    public function getDetails()
    {
        return $this->getProperty("Details");
    }
    /**
     * @var string
     */
    public function setDetails($value)
    {
        return $this->setProperty("Details", $value, true);
    }
    /**
     * @return string
     */
    public function getId()
    {
        return $this->getProperty("Id");
    }
    /**
     * @var string
     */
    public function setId($value)
    {
        return $this->setProperty("Id", $value, true);
    }
    /**
     * @return integer
     */
    public function getStatus()
    {
        return $this->getProperty("Status");
    }
    /**
     * @var integer
     */
    public function setStatus($value)
    {
        return $this->setProperty("Status", $value, true);
    }
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getProperty("Title");
    }
    /**
     * @var string
     */
    public function setTitle($value)
    {
        return $this->setProperty("Title", $value, true);
    }
    /**
     * @return string
     */
    public function getActions()
    {
        return $this->getProperty("Actions");
    }
    /**
     * @var string
     */
    public function setActions($value)
    {
        return $this->setProperty("Actions", $value, true);
    }
    /**
     * @return bool
     */
    public function getAllowResubmit()
    {
        return $this->getProperty("AllowResubmit");
    }
    /**
     * @var bool
     */
    public function setAllowResubmit($value)
    {
        return $this->setProperty("AllowResubmit", $value, true);
    }
    /**
     * @return string
     */
    public function getApprovers()
    {
        return $this->getProperty("Approvers");
    }
    /**
     * @var string
     */
    public function setApprovers($value)
    {
        return $this->setProperty("Approvers", $value, true);
    }
    /**
     * @return string
     */
    public function getResponses()
    {
        return $this->getProperty("Responses");
    }
    /**
     * @var string
     */
    public function setResponses($value)
    {
        return $this->setProperty("Responses", $value, true);
    }
    /**
     * @return string
     */
    public function getPartnerMetadata()
    {
        return $this->getProperty("PartnerMetadata");
    }
    /**
     * @var string
     */
    public function setPartnerMetadata($value)
    {
        return $this->setProperty("PartnerMetadata", $value, true);
    }
    /**
     * @return integer
     */
    public function getPriority()
    {
        return $this->getProperty("Priority");
    }
    /**
     * @var integer
     */
    public function setPriority($value)
    {
        return $this->setProperty("Priority", $value, true);
    }
}