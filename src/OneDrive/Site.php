<?php

/**
 * Modified: 2020-05-27T07:36:43+00:00 
 */
namespace Office365\OneDrive;


use Office365\OneNote\Onenote;
use Office365\Runtime\ResourcePath;
/**
 * The **site** resource provides metadata and relationships for a SharePoint site.
 */
class Site extends BaseItem
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
     * @return Onenote
     */
    public function getOnenote()
    {
        return $this->getProperty("Onenote",
            new Onenote($this->getContext(), new ResourcePath("Onenote", $this->getResourcePath())));
    }
    /**
     * @return Root
     */
    public function getRoot()
    {
        return $this->getProperty("Root", new Root());
    }
    /**
     * @var Root
     */
    public function setRoot($value)
    {
        $this->setProperty("Root", $value, true);
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
     * @return SiteCollection
     */
    public function getSiteCollection()
    {
        return $this->getProperty("SiteCollection", new SiteCollection());
    }
    /**
     * @var SiteCollection
     */
    public function setSiteCollection($value)
    {
        $this->setProperty("SiteCollection", $value, true);
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
     * @return SiteCollection
     */
    public function getSites()
    {
        return $this->getProperty("Sites", new SiteCollection());
    }
    /**
     * @return DriveCollection
     */
    public function getDrives()
    {
        return $this->getProperty("Drives",
            new DriveCollection($this->getContext(), new ResourcePath("Drives", $this->getResourcePath())));
    }



}