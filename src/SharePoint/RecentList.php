<?php

/**
 * Updated By PHP Office365 Generator 2019-12-21T23:09:34+00:00 16.0.19520.12047
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObject;


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
    /**
     * @return string
     */
    public function getsiteId()
    {
        if (!$this->isPropertyAvailable("siteId")) {
            return null;
        }
        return $this->getProperty("siteId");
    }
    /**
     * @var string
     */
    public function setsiteId($value)
    {
        $this->setProperty("siteId", $value, true);
    }
}
