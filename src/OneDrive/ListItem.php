<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\OneDrive;

use Office365\Entity;
use Office365\EntityCollection;
use Office365\Runtime\ResourcePath;
/**
 *  Represents an item in a sharepoint list.
 */
class ListItem extends Entity
{
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
     * @return ItemAnalytics
     */
    public function getAnalytics()
    {
        return $this->getProperty("Analytics",
            new ItemAnalytics($this->getContext(), new ResourcePath("Analytics", $this->getResourcePath())));
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
     * @return ContentTypeInfo
     */
    public function getContentType()
    {
        return $this->getProperty("ContentType", new ContentTypeInfo());
    }
    /**
     * @var ContentTypeInfo
     */
    public function setContentType($value)
    {
        $this->setProperty("ContentType", $value, true);
    }
    /**
     * @return FieldValueSet
     */
    public function getFields()
    {
        return $this->getProperty("Fields",
            new FieldValueSet($this->getContext(), new ResourcePath("Fields", $this->getResourcePath())));
    }

    /**
     * @return EntityCollection
     */
    public function getVersions(){
        return $this->getProperty("versions",
            new EntityCollection($this->getContext(),
                new ResourcePath("versions", $this->getResourcePath()),ListItemVersion::class));
    }
}