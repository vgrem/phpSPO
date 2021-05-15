<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\OneNote;


/**
 * A OneNote notebook.
 */
class Notebook extends OnenoteEntityHierarchyModel
{
    /**
     * Indicates whether this is the user's default notebook. Read-only.
     * @return bool
     */
    public function getIsDefault()
    {
        return $this->getProperty("IsDefault");
    }
    /**
     * Indicates whether this is the user's default notebook. Read-only.
     * @var bool
     */
    public function setIsDefault($value)
    {
        $this->setProperty("IsDefault", $value, true);
    }
    /**
     * Indicates whether the notebook is shared. If true, the contents of the notebook can be seen by people other than the owner. Read-only.
     * @return bool
     */
    public function getIsShared()
    {
        return $this->getProperty("IsShared");
    }
    /**
     * Indicates whether the notebook is shared. If true, the contents of the notebook can be seen by people other than the owner. Read-only.
     * @var bool
     */
    public function setIsShared($value)
    {
        $this->setProperty("IsShared", $value, true);
    }
    /**
     * The URL for the `sections` navigation property, which returns all the sections in the notebook. Read-only.
     * @return string
     */
    public function getSectionsUrl()
    {
        return $this->getProperty("SectionsUrl");
    }
    /**
     * The URL for the `sections` navigation property, which returns all the sections in the notebook. Read-only.
     * @var string
     */
    public function setSectionsUrl($value)
    {
        $this->setProperty("SectionsUrl", $value, true);
    }
    /**
     * The URL for the `sectionGroups` navigation property, which returns all the section groups in the notebook. Read-only.
     * @return string
     */
    public function getSectionGroupsUrl()
    {
        return $this->getProperty("SectionGroupsUrl");
    }

    /**
     * The URL for the `sectionGroups` navigation property, which returns all the section groups in the notebook. Read-only.
     *
     * @return self
     * @var string
     */
    public function setSectionGroupsUrl($value)
    {
        return $this->setProperty("SectionGroupsUrl", $value, true);
    }
    /**
     * Links for opening the notebook. The `oneNoteClientURL` link opens the notebook in the OneNote native client if it's installed. The `oneNoteWebURL` link opens the notebook in OneNote on the web.
     * @return NotebookLinks
     */
    public function getLinks()
    {
        return $this->getProperty("Links", new NotebookLinks());
    }

    /**
     * Links for opening the notebook. The `oneNoteClientURL` link opens the notebook in the OneNote native client if it's installed. The `oneNoteWebURL` link opens the notebook in OneNote on the web.
     *
     * @return self
     * @var NotebookLinks
     */
    public function setLinks($value)
    {
        return $this->setProperty("Links", $value, true);
    }
}