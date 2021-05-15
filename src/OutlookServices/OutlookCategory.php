<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Entity;

/**
 *  "Represents a category by which a user can group Outlook items such as messages and events. The user defines categories in a master list, and can apply one or more of these user-defined"
 */
class OutlookCategory extends Entity
{
    /**
     * A unique name that identifies a category in the user's mailbox. After a category is created, the name cannot be changed. Read-only.
     * @return string
     */
    public function getDisplayName()
    {
        if (!$this->isPropertyAvailable("DisplayName")) {
            return null;
        }
        return $this->getProperty("DisplayName");
    }
    /**
     * A unique name that identifies a category in the user's mailbox. After a category is created, the name cannot be changed. Read-only.
     * @var string
     */
    public function setDisplayName($value)
    {
        $this->setProperty("DisplayName", $value, true);
    }
}