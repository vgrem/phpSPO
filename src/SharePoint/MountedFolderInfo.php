<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T17:00:44+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
/**
 * Provides 
 * read-only properties that describe a mounted folder.
 */
class MountedFolderInfo extends ClientObject
{
    /**
     * @return string
     */
    public function getFolderUrl()
    {
        if (!$this->isPropertyAvailable("FolderUrl")) {
            return null;
        }
        return $this->getProperty("FolderUrl");
    }
    /**
     * @var string
     */
    public function setFolderUrl($value)
    {
        $this->setProperty("FolderUrl", $value, true);
    }
    /**
     * @return bool
     */
    public function getHasEditPermission()
    {
        if (!$this->isPropertyAvailable("HasEditPermission")) {
            return null;
        }
        return $this->getProperty("HasEditPermission");
    }
    /**
     * @var bool
     */
    public function setHasEditPermission($value)
    {
        $this->setProperty("HasEditPermission", $value, true);
    }
    /**
     * @return integer
     */
    public function getItemId()
    {
        if (!$this->isPropertyAvailable("ItemId")) {
            return null;
        }
        return $this->getProperty("ItemId");
    }
    /**
     * @var integer
     */
    public function setItemId($value)
    {
        $this->setProperty("ItemId", $value, true);
    }
    /**
     * @return integer
     */
    public function getListTemplateType()
    {
        if (!$this->isPropertyAvailable("ListTemplateType")) {
            return null;
        }
        return $this->getProperty("ListTemplateType");
    }
    /**
     * @var integer
     */
    public function setListTemplateType($value)
    {
        $this->setProperty("ListTemplateType", $value, true);
    }
    /**
     * @return string
     */
    public function getListViewUrl()
    {
        if (!$this->isPropertyAvailable("ListViewUrl")) {
            return null;
        }
        return $this->getProperty("ListViewUrl");
    }
    /**
     * @var string
     */
    public function setListViewUrl($value)
    {
        $this->setProperty("ListViewUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getWebUrl()
    {
        if (!$this->isPropertyAvailable("WebUrl")) {
            return null;
        }
        return $this->getProperty("WebUrl");
    }
    /**
     * @var string
     */
    public function setWebUrl($value)
    {
        $this->setProperty("WebUrl", $value, true);
    }
}