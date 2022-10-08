<?php

/**
 * Generated  2022-10-08T10:32:22+03:00 16.0.22921.12007
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
}