<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\OneDrive;

use Office365\Common\IncompleteData;
use Office365\Entity;

class ItemActivityStat extends Entity
{
    /**
     * @return bool
     */
    public function getIsTrending()
    {
        if (!$this->isPropertyAvailable("IsTrending")) {
            return null;
        }
        return $this->getProperty("IsTrending");
    }
    /**
     * @var bool
     */
    public function setIsTrending($value)
    {
        $this->setProperty("IsTrending", $value, true);
    }
    /**
     * @return ItemActionStat
     */
    public function getAccess()
    {
        if (!$this->isPropertyAvailable("Access")) {
            return null;
        }
        return $this->getProperty("Access");
    }
    /**
     * @var ItemActionStat
     */
    public function setAccess($value)
    {
        $this->setProperty("Access", $value, true);
    }
    /**
     * @return ItemActionStat
     */
    public function getCreate()
    {
        if (!$this->isPropertyAvailable("Create")) {
            return null;
        }
        return $this->getProperty("Create");
    }
    /**
     * @var ItemActionStat
     */
    public function setCreate($value)
    {
        $this->setProperty("Create", $value, true);
    }
    /**
     * @return ItemActionStat
     */
    public function getDelete()
    {
        if (!$this->isPropertyAvailable("Delete")) {
            return null;
        }
        return $this->getProperty("Delete");
    }
    /**
     * @var ItemActionStat
     */
    public function setDelete($value)
    {
        $this->setProperty("Delete", $value, true);
    }
    /**
     * @return ItemActionStat
     */
    public function getEdit()
    {
        if (!$this->isPropertyAvailable("Edit")) {
            return null;
        }
        return $this->getProperty("Edit");
    }
    /**
     * @var ItemActionStat
     */
    public function setEdit($value)
    {
        $this->setProperty("Edit", $value, true);
    }
    /**
     * @return ItemActionStat
     */
    public function getMove()
    {
        if (!$this->isPropertyAvailable("Move")) {
            return null;
        }
        return $this->getProperty("Move");
    }
    /**
     * @var ItemActionStat
     */
    public function setMove($value)
    {
        $this->setProperty("Move", $value, true);
    }
    /**
     * @return IncompleteData
     */
    public function getIncompleteData()
    {
        if (!$this->isPropertyAvailable("IncompleteData")) {
            return null;
        }
        return $this->getProperty("IncompleteData");
    }
    /**
     * @var IncompleteData
     */
    public function setIncompleteData($value)
    {
        $this->setProperty("IncompleteData", $value, true);
    }
}