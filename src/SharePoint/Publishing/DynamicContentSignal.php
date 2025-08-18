<?php

/**
 * Generated  2025-08-18T13:04:30+00:00 16.0.26330.12013
 */
namespace Office365\SharePoint\Publishing;


use Office365\SharePoint\BaseEntity;

class DynamicContentSignal extends BaseEntity
{
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
    public function getitemId()
    {
        return $this->getProperty("itemId");
    }
    /**
     * @var integer
     */
    public function setitemId($value)
    {
        return $this->setProperty("itemId", $value, true);
    }
}