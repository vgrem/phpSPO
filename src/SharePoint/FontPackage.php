<?php

/**
 * Generated  2024-02-24T10:21:51+00:00 16.0.24607.12008
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientObject;
use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\Actions\UpdateEntityQuery;
class FontPackage extends BaseEntity
{
    /**
     * @return string
     */
    public function getID()
    {
        return $this->getProperty("ID");
    }
    /**
     * @var string
     */
    public function setID($value)
    {
        return $this->setProperty("ID", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsHidden()
    {
        return $this->getProperty("IsHidden");
    }
    /**
     * @var bool
     */
    public function setIsHidden($value)
    {
        return $this->setProperty("IsHidden", $value, true);
    }
    /**
     * @return string
     */
    public function getPackageJson()
    {
        return $this->getProperty("PackageJson");
    }
    /**
     * @var string
     */
    public function setPackageJson($value)
    {
        return $this->setProperty("PackageJson", $value, true);
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
     * @return bool
     */
    public function getIsValid()
    {
        return $this->getProperty("IsValid");
    }
    /**
     * @var bool
     */
    public function setIsValid($value)
    {
        return $this->setProperty("IsValid", $value, true);
    }
    /**
     * @return integer
     */
    public function getStore()
    {
        return $this->getProperty("Store");
    }
    /**
     * @var integer
     */
    public function setStore($value)
    {
        return $this->setProperty("Store", $value, true);
    }
}