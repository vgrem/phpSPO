<?php

/**
 * Modified: 2020-05-24T22:03:02+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Entity;

/**
 *  "A mail folder in a user's mailbox, such as Inbox and Drafts. Mail folders can contain messages, other Outlook items, and child mail folders."
 */
class MailFolder extends Entity
{
    /**
     * The mailFolder's display name.
     * @return string
     */
    public function getDisplayName()
    {
        return $this->getProperty("DisplayName");
    }

    /**
     * The mailFolder's display name.
     *
     * @return self
     * @var string
     */
    public function setDisplayName($value)
    {
        return $this->setProperty("DisplayName", $value, true);
    }
    /**
     * The unique identifier for the mailFolder's parent mailFolder.
     * @return string
     */
    public function getParentFolderId()
    {
        return $this->getProperty("ParentFolderId");
    }
    /**
     * The unique identifier for the mailFolder's parent mailFolder.
     * @var string
     */
    public function setParentFolderId($value)
    {
        $this->setProperty("ParentFolderId", $value, true);
    }
    /**
     * The number of immediate child mailFolders in the current mailFolder.
     * @return integer
     */
    public function getChildFolderCount()
    {
        return $this->getProperty("ChildFolderCount");
    }
    /**
     * The number of immediate child mailFolders in the current mailFolder.
     * @var integer
     */
    public function setChildFolderCount($value)
    {
        $this->setProperty("ChildFolderCount", $value, true);
    }
    /**
     * The number of items in the mailFolder marked as unread.
     * @return integer
     */
    public function getUnreadItemCount()
    {
        return $this->getProperty("UnreadItemCount");
    }
    /**
     * The number of items in the mailFolder marked as unread.
     * @var integer
     */
    public function setUnreadItemCount($value)
    {
        $this->setProperty("UnreadItemCount", $value, true);
    }
    /**
     * The number of items in the mailFolder.
     * @return integer
     */
    public function getTotalItemCount()
    {
        return $this->getProperty("TotalItemCount");
    }
    /**
     * The number of items in the mailFolder.
     * @var integer
     */
    public function setTotalItemCount($value)
    {
        $this->setProperty("TotalItemCount", $value, true);
    }
}