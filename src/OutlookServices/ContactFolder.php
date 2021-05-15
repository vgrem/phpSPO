<?php

/**
 * Modified: 2020-05-24T22:08:35+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Entity;

/**
 *  "A folder that contains contacts."
 */
class ContactFolder extends Entity
{
    /**
     * The ID of the folder's parent folder.
     * @return string
     */
    public function getParentFolderId()
    {
        return $this->getProperty("ParentFolderId");
    }
    /**
     * The ID of the folder's parent folder.
     * @var string
     */
    public function setParentFolderId($value)
    {
        $this->setProperty("ParentFolderId", $value, true);
    }
    /**
     * The folder's display name.
     * @return string
     */
    public function getDisplayName()
    {
        return $this->getProperty("DisplayName");
    }

    /**
     * The folder's display name.
     *
     * @return self
     * @var string
     */
    public function setDisplayName($value)
    {
        return $this->setProperty("DisplayName", $value, true);
    }
}