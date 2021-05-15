<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Entity;
/**
 * A **mailSearchFolder** is a virtual folder in the user's mailbox that contains all the email items matching specified search criteria. **mailSearchFolder** inherits from [mailFolder](mailfolder.md). Search folders can be created in any folder in a user's Exchange Online mailbox. However, for a search folder to appear in Outlook, Outlook for the web, or Outlook Live, the folder must be created in the **WellKnownFolderName.SearchFolders** folder. 
 */
class MailSearchFolder extends Entity
{
    /**
     * @return bool
     */
    public function getIsSupported()
    {
        if (!$this->isPropertyAvailable("IsSupported")) {
            return null;
        }
        return $this->getProperty("IsSupported");
    }
    /**
     * @var bool
     */
    public function setIsSupported($value)
    {
        $this->setProperty("IsSupported", $value, true);
    }
    /**
     * @return bool
     */
    public function getIncludeNestedFolders()
    {
        if (!$this->isPropertyAvailable("IncludeNestedFolders")) {
            return null;
        }
        return $this->getProperty("IncludeNestedFolders");
    }
    /**
     * @var bool
     */
    public function setIncludeNestedFolders($value)
    {
        $this->setProperty("IncludeNestedFolders", $value, true);
    }
    /**
     * @return array
     */
    public function getSourceFolderIds()
    {
        if (!$this->isPropertyAvailable("SourceFolderIds")) {
            return null;
        }
        return $this->getProperty("SourceFolderIds");
    }
    /**
     * @var array
     */
    public function setSourceFolderIds($value)
    {
        $this->setProperty("SourceFolderIds", $value, true);
    }
    /**
     * @return string
     */
    public function getFilterQuery()
    {
        if (!$this->isPropertyAvailable("FilterQuery")) {
            return null;
        }
        return $this->getProperty("FilterQuery");
    }
    /**
     * @var string
     */
    public function setFilterQuery($value)
    {
        $this->setProperty("FilterQuery", $value, true);
    }
}