<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\OneNote;

use Office365\Entity;
use Office365\Runtime\ResourcePath;
class OnenotePage extends Entity
{
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getProperty("Title");
    }
    /**
     * @var string
     */
    public function setTitle($value)
    {
        $this->setProperty("Title", $value, true);
    }
    /**
     * @return string
     */
    public function getCreatedByAppId()
    {
        return $this->getProperty("CreatedByAppId");
    }
    /**
     * @var string
     */
    public function setCreatedByAppId($value)
    {
        $this->setProperty("CreatedByAppId", $value, true);
    }
    /**
     * @return string
     */
    public function getContentUrl()
    {
        return $this->getProperty("ContentUrl");
    }
    /**
     * @var string
     */
    public function setContentUrl($value)
    {
        $this->setProperty("ContentUrl", $value, true);
    }
    /**
     * @return integer
     */
    public function getLevel()
    {
        return $this->getProperty("Level");
    }
    /**
     * @var integer
     */
    public function setLevel($value)
    {
        $this->setProperty("Level", $value, true);
    }
    /**
     * @return integer
     */
    public function getOrder()
    {
        return $this->getProperty("Order");
    }
    /**
     * @var integer
     */
    public function setOrder($value)
    {
        $this->setProperty("Order", $value, true);
    }
    /**
     * @return array
     */
    public function getUserTags()
    {
        return $this->getProperty("UserTags");
    }
    /**
     * @var array
     */
    public function setUserTags($value)
    {
        $this->setProperty("UserTags", $value, true);
    }
    /**
     * @return PageLinks
     */
    public function getLinks()
    {
        return $this->getProperty("Links", new PageLinks());
    }
    /**
     * @var PageLinks
     */
    public function setLinks($value)
    {
        $this->setProperty("Links", $value, true);
    }
    /**
     * @return OnenoteSection
     */
    public function getParentSection()
    {
        return $this->getProperty("ParentSection",
            new OnenoteSection($this->getContext(), new ResourcePath("ParentSection", $this->getResourcePath())));
    }
    /**
     * @return Notebook
     */
    public function getParentNotebook()
    {
        return $this->getProperty("ParentNotebook",
            new Notebook($this->getContext(), new ResourcePath("ParentNotebook", $this->getResourcePath())));
    }
}