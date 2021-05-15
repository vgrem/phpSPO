<?php

/**
 * Modified: 2020-05-27T08:42:11+00:00 
 */
namespace Office365\OneNote;

use Office365\Entity;
use Office365\Runtime\ResourcePath;
class OnenoteSection extends Entity
{
    /**
     * @return bool
     */
    public function getIsDefault()
    {
        return $this->getProperty("IsDefault");
    }

    /**
     *
     * @return self
     * @var bool
     */
    public function setIsDefault($value)
    {
        return $this->setProperty("IsDefault", $value, true);
    }
    /**
     * @return string
     */
    public function getPagesUrl()
    {
        return $this->getProperty("PagesUrl");
    }
    /**
     * @var string
     */
    public function setPagesUrl($value)
    {
        $this->setProperty("PagesUrl", $value, true);
    }
    /**
     * @return SectionLinks
     */
    public function getLinks()
    {
        return $this->getProperty("Links", new SectionLinks());
    }
    /**
     * @var SectionLinks
     */
    public function setLinks($value)
    {
        $this->setProperty("Links", $value, true);
    }
    /**
     * @return Notebook
     */
    public function getParentNotebook()
    {
        return $this->getProperty("ParentNotebook",
            new Notebook($this->getContext(), new ResourcePath("ParentNotebook", $this->getResourcePath())));
    }
    /**
     * @return SectionGroup
     */
    public function getParentSectionGroup()
    {
        return $this->getProperty("ParentSectionGroup",
            new SectionGroup($this->getContext(), 
                new ResourcePath("ParentSectionGroup", $this->getResourcePath())));
    }
    /**
     * @return OnenotePageCollection
     */
    public function getPages()
    {
        return $this->getProperty("Pages",
            new OnenotePageCollection($this->getContext(), new ResourcePath("Pages", $this->getResourcePath())));
    }
}