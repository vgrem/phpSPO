<?php

/**
 * Modified: 2020-05-26T22:30:38+00:00 
 */
namespace Office365\OneDrive;

use Office365\Common\IdentitySet;
use Office365\Entity;
use Office365\Runtime\ResourcePath;
class SharedDriveItem extends Entity
{
    /**
     * @return IdentitySet
     */
    public function getOwner()
    {
        return $this->getProperty("Owner", new IdentitySet());
    }

    /**
     *
     * @return SharedDriveItem
     * @var IdentitySet
     */
    public function setOwner($value)
    {
        return $this->setProperty("Owner", $value, true);
    }
    /**
     * @return DriveItem
     */
    public function getDriveItem()
    {
        return $this->getProperty("DriveItem",
            new DriveItem($this->getContext(), new ResourcePath("DriveItem", $this->getResourcePath())));
    }
    /**
     * @return SharePointList
     */
    public function getList()
    {
        return $this->getProperty("List",
            new SharePointList($this->getContext(), new ResourcePath("List", $this->getResourcePath())));
    }
    /**
     * @return ListItem
     */
    public function getListItem()
    {
        return $this->getProperty("ListItem",
            new ListItem($this->getContext(), new ResourcePath("ListItem", $this->getResourcePath())));
    }
    /**
     * @return DriveItem
     */
    public function getRoot()
    {
        return $this->getProperty("Root",
            new DriveItem($this->getContext(), new ResourcePath("Root", $this->getResourcePath())));
    }
    /**
     * @return Site
     */
    public function getSite()
    {
        return $this->getProperty("Site",
            new Site($this->getContext(), new ResourcePath("Site", $this->getResourcePath())));
    }
    /**
     * @return DriveItemCollection
     */
    public function getItems()
    {
        return $this->getProperty("Items",
            new DriveItemCollection($this->getContext(), new ResourcePath("Items", $this->getResourcePath())));
    }
}