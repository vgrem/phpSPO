<?php

/**
 * Modified: 2020-05-25T06:42:59+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;
use Office365\Common\Json;
use Office365\Runtime\ResourcePath;
class WorkbookNamedItem extends Entity
{
    /**
     * @return string
     */
    public function getComment()
    {
        if (!$this->isPropertyAvailable("Comment")) {
            return null;
        }
        return $this->getProperty("Comment");
    }
    /**
     * @var string
     */
    public function setComment($value)
    {
        $this->setProperty("Comment", $value, true);
    }
    /**
     * @return string
     */
    public function getName()
    {
        if (!$this->isPropertyAvailable("Name")) {
            return null;
        }
        return $this->getProperty("Name");
    }
    /**
     * @var string
     */
    public function setName($value)
    {
        $this->setProperty("Name", $value, true);
    }
    /**
     * @return string
     */
    public function getScope()
    {
        if (!$this->isPropertyAvailable("Scope")) {
            return null;
        }
        return $this->getProperty("Scope");
    }
    /**
     * @var string
     */
    public function setScope($value)
    {
        $this->setProperty("Scope", $value, true);
    }
    /**
     * @return string
     */
    public function getType()
    {
        if (!$this->isPropertyAvailable("Type")) {
            return null;
        }
        return $this->getProperty("Type");
    }
    /**
     * @var string
     */
    public function setType($value)
    {
        $this->setProperty("Type", $value, true);
    }
    /**
     * @return bool
     */
    public function getVisible()
    {
        if (!$this->isPropertyAvailable("Visible")) {
            return null;
        }
        return $this->getProperty("Visible");
    }
    /**
     * @var bool
     */
    public function setVisible($value)
    {
        $this->setProperty("Visible", $value, true);
    }
    /**
     * @return Json
     */
    public function getValue()
    {
        if (!$this->isPropertyAvailable("Value")) {
            return null;
        }
        return $this->getProperty("Value");
    }
    /**
     * @var Json
     */
    public function setValue($value)
    {
        $this->setProperty("Value", $value, true);
    }
    /**
     * @return WorkbookWorksheet
     */
    public function getWorksheet()
    {
        if (!$this->isPropertyAvailable("Worksheet")) {
            $this->setProperty("Worksheet", new WorkbookWorksheet($this->getContext(), new ResourcePath("Worksheet", $this->getResourcePath())));
        }
        return $this->getProperty("Worksheet");
    }
}