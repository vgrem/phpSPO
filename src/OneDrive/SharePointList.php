<?php

/**
 * Modified: 2020-05-26T22:35:11+00:00 
 */
namespace Office365\OneDrive;

use Office365\Entity;
use Office365\Runtime\ResourcePath;
/**
 *  "The list resource represents a list in a site."
 */
class SharePointList extends Entity
{
    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->getProperty("DisplayName");
    }
    /**
     * @var string
     */
    public function setDisplayName($value)
    {
        $this->setProperty("DisplayName", $value, true);
    }
    /**
     * @return Drive
     */
    public function getDrive()
    {
        return $this->getProperty("Drive",
            new Drive($this->getContext(), new ResourcePath("Drive", $this->getResourcePath())));
    }
    /**
     * @return ListInfo
     */
    public function getList()
    {
        return $this->getProperty("List", new ListInfo());
    }
    /**
     * @var ListInfo
     */
    public function setList($value)
    {
        $this->setProperty("List", $value, true);
    }
    /**
     * @return SharepointIds
     */
    public function getSharepointIds()
    {
        return $this->getProperty("SharepointIds", new SharepointIds());
    }
    /**
     * @var SharepointIds
     */
    public function setSharepointIds($value)
    {
        $this->setProperty("SharepointIds", $value, true);
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
     * @return ListItemCollection
     */
    public function getItems()
    {
        return $this->getProperty("Items",
            new ListItemCollection($this->getContext(), new ResourcePath("Items", $this->getResourcePath())));
    }
}