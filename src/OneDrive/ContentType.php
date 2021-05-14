<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\OneDrive;

use Office365\Entity;

class ContentType extends Entity
{
    /**
     * @return string
     */
    public function getDescription()
    {
        if (!$this->isPropertyAvailable("Description")) {
            return null;
        }
        return $this->getProperty("Description");
    }
    /**
     * @var string
     */
    public function setDescription($value)
    {
        $this->setProperty("Description", $value, true);
    }
    /**
     * @return string
     */
    public function getGroup()
    {
        if (!$this->isPropertyAvailable("Group")) {
            return null;
        }
        return $this->getProperty("Group");
    }
    /**
     * @var string
     */
    public function setGroup($value)
    {
        $this->setProperty("Group", $value, true);
    }
    /**
     * @return bool
     */
    public function getHidden()
    {
        if (!$this->isPropertyAvailable("Hidden")) {
            return null;
        }
        return $this->getProperty("Hidden");
    }
    /**
     * @var bool
     */
    public function setHidden($value)
    {
        $this->setProperty("Hidden", $value, true);
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
    public function getParentId()
    {
        if (!$this->isPropertyAvailable("ParentId")) {
            return null;
        }
        return $this->getProperty("ParentId");
    }
    /**
     * @var string
     */
    public function setParentId($value)
    {
        $this->setProperty("ParentId", $value, true);
    }
    /**
     * @return bool
     */
    public function getReadOnly()
    {
        if (!$this->isPropertyAvailable("ReadOnly")) {
            return null;
        }
        return $this->getProperty("ReadOnly");
    }
    /**
     * @var bool
     */
    public function setReadOnly($value)
    {
        $this->setProperty("ReadOnly", $value, true);
    }
    /**
     * @return bool
     */
    public function getSealed()
    {
        if (!$this->isPropertyAvailable("Sealed")) {
            return null;
        }
        return $this->getProperty("Sealed");
    }
    /**
     * @var bool
     */
    public function setSealed($value)
    {
        $this->setProperty("Sealed", $value, true);
    }
    /**
     * @return ItemReference
     */
    public function getInheritedFrom()
    {
        if (!$this->isPropertyAvailable("InheritedFrom")) {
            return null;
        }
        return $this->getProperty("InheritedFrom");
    }
    /**
     * @var ItemReference
     */
    public function setInheritedFrom($value)
    {
        $this->setProperty("InheritedFrom", $value, true);
    }
    /**
     * @return ContentTypeOrder
     */
    public function getOrder()
    {
        if (!$this->isPropertyAvailable("Order")) {
            return null;
        }
        return $this->getProperty("Order");
    }
    /**
     * @var ContentTypeOrder
     */
    public function setOrder($value)
    {
        $this->setProperty("Order", $value, true);
    }
}