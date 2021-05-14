<?php

/**
 * Modified: 2020-05-26T22:30:38+00:00 
 */
namespace Office365\OneDrive;


use Office365\Common\IdentitySet;
use Office365\Runtime\ResourcePath;
/**
 *  "The drive resource is the top level object representing a user's OneDrive or a document library in SharePoint."
 */
class Drive extends BaseItem
{
    /**
     * @return string
     */
    public function getDriveType()
    {
        return $this->getProperty("DriveType");
    }

    /**
     * @return self
     * @var string
     */
    public function setDriveType($value)
    {
        return $this->setProperty("DriveType", $value, true);
    }
    /**
     * @return IdentitySet
     */
    public function getOwner()
    {
        return $this->getProperty("Owner", new IdentitySet());
    }

    /**
     *
     * @return self
     * @var IdentitySet
     */
    public function setOwner($value)
    {
        return $this->setProperty("Owner", $value, true);
    }
    /**
     * @return Quota
     */
    public function getQuota()
    {
        return $this->getProperty("Quota", new Quota());
    }

    /**
     *
     * @return self
     * @var Quota
     */
    public function setQuota($value)
    {
        return $this->setProperty("Quota", $value, true);
    }
    /**
     * @return SharepointIds
     */
    public function getSharePointIds()
    {
        return $this->getProperty("SharePointIds", new SharepointIds());
    }
    /**
     * @var SharepointIds
     */
    public function setSharePointIds($value)
    {
        $this->setProperty("SharePointIds", $value, true);
    }
    /**
     * @return SystemFacet
     */
    public function getSystem()
    {
        return $this->getProperty("System", new SystemFacet());
    }
    /**
     * @var SystemFacet
     */
    public function setSystem($value)
    {
        $this->setProperty("System", $value, true);
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
     * @return DriveItem
     */
    public function getRoot()
    {
        return $this->getProperty("Root",
            new DriveItem($this->getContext(), new ResourcePath("Root", $this->getResourcePath())));
    }
    /**
     * @return DriveItemCollection
     */
    public function getItems()
    {
        return $this->getProperty("Items",
            new DriveItemCollection($this->getContext(), new ResourcePath("Items", $this->getResourcePath())));
    }
    /**
     * @return DriveItemCollection
     */
    public function getSpecial()
    {
        return $this->getProperty("Special",
            new DriveItemCollection($this->getContext(), new ResourcePath("Special", $this->getResourcePath())));
    }
}