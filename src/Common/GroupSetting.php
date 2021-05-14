<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00
 */
namespace Office365\Common;

use Office365\Entity;


/**
 *  "Group settings control behaviors such as blocked word lists for group display names or whether guest users are allowed to be group owners."
 */
class GroupSetting extends Entity
{
    /**
     *  Display name of this group of settings, which comes from the associated template. 
     * @return string
     */
    public function getDisplayName()
    {
        return $this->getProperty("DisplayName");
    }
    /**
     *  Display name of this group of settings, which comes from the associated template. 
     * @var string
     */
    public function setDisplayName($value)
    {
        $this->setProperty("DisplayName", $value, true);
    }
    /**
     *  Unique identifier for the template used to create this group of settings. Read-only. 
     * @return string
     */
    public function getTemplateId()
    {
        return $this->getProperty("TemplateId");
    }
    /**
     *  Unique identifier for the template used to create this group of settings. Read-only. 
     * @var string
     */
    public function setTemplateId($value)
    {
        $this->setProperty("TemplateId", $value, true);
    }
}