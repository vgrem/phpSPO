<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\OneNote;

use Office365\Entity;
use Office365\Runtime\ResourcePath;

/**
 * A section group in a OneNote notebook. Section groups can contain sections and section groups.
 */
class SectionGroup extends Entity
{
    /**
     * The URL for the `sections` navigation property, which returns all the sections in the section group. Read-only.
     * @return string
     */
    public function getSectionsUrl()
    {
        return $this->getProperty("SectionsUrl");
    }
    /**
     * The URL for the `sections` navigation property, which returns all the sections in the section group. Read-only.
     * @var string
     */
    public function setSectionsUrl($value)
    {
        $this->setProperty("SectionsUrl", $value, true);
    }
    /**
     * The URL for the `sectionGroups` navigation property, which returns all the section groups in the section group. Read-only.
     * @return string
     */
    public function getSectionGroupsUrl()
    {
        return $this->getProperty("SectionGroupsUrl");
    }

    /**
     * The URL for the `sectionGroups` navigation property, which returns all the section groups in the section group. Read-only.
     *
     * @return self
     * @var string
     */
    public function setSectionGroupsUrl($value)
    {
        return $this->setProperty("SectionGroupsUrl", $value, true);
    }
    /**
     * The notebook that contains the section group. Read-only.
     * @return Notebook
     */
    public function getParentNotebook()
    {
        return $this->getProperty("ParentNotebook",
            new Notebook($this->getContext(), new ResourcePath("ParentNotebook", $this->getResourcePath())));
    }
    /**
     * The section group that contains the section group. Read-only.
     * @return SectionGroup
     */
    public function getParentSectionGroup()
    {
        return $this->getProperty("ParentSectionGroup",
            new SectionGroup($this->getContext(),
                new ResourcePath("ParentSectionGroup", $this->getResourcePath())));
    }
}