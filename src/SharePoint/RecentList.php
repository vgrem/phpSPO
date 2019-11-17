<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T17:00:44+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;

class RecentList extends ClientObject
{
    /**
     * @return integer
     */
    public function getlastViewDate()
    {
        if (!$this->isPropertyAvailable("lastViewDate")) {
            return null;
        }
        return $this->getProperty("lastViewDate");
    }
    /**
     * @var integer
     */
    public function setlastViewDate($value)
    {
        $this->setProperty("lastViewDate", $value, true);
    }
    /**
     * @return string
     */
    public function getlistId()
    {
        if (!$this->isPropertyAvailable("listId")) {
            return null;
        }
        return $this->getProperty("listId");
    }
    /**
     * @var string
     */
    public function setlistId($value)
    {
        $this->setProperty("listId", $value, true);
    }
    /**
     * @return string
     */
    public function getlistTitle()
    {
        if (!$this->isPropertyAvailable("listTitle")) {
            return null;
        }
        return $this->getProperty("listTitle");
    }
    /**
     * @var string
     */
    public function setlistTitle($value)
    {
        $this->setProperty("listTitle", $value, true);
    }
    /**
     * @return string
     */
    public function getlistUrl()
    {
        if (!$this->isPropertyAvailable("listUrl")) {
            return null;
        }
        return $this->getProperty("listUrl");
    }
    /**
     * @var string
     */
    public function setlistUrl($value)
    {
        $this->setProperty("listUrl", $value, true);
    }
}