<?php

/**
 * Generated  2023-09-30T09:13:50+00:00 16.0.24106.12014
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
}