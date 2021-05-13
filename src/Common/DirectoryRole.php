<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

/**
 *  "Represents an Azure AD directory role. Azure AD directory roles are also known as *administrator roles*."
 */
class DirectoryRole extends ClientObject
{
    /**
     * The description for the directory role. Read-only. 
     * @return string
     */
    public function getDescription()
    {
        if (!$this->isPropertyAvailable("Description")) {
            return null;
        }
        return $this->getProperty("Description");
    }
    /**
     * The description for the directory role. Read-only. 
     * @var string
     */
    public function setDescription($value)
    {
        $this->setProperty("Description", $value, true);
    }
    /**
     * The display name for the directory role. Read-only. 
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
     * The display name for the directory role. Read-only. 
     * @var string
     */
    public function setDisplayName($value)
    {
        $this->setProperty("DisplayName", $value, true);
    }
    /**
     *  The **id** of the [directoryRoleTemplate](directoryroletemplate.md) that this role is based on. The property must be specified when activating a directory role in a tenant with a POST operation. After the directory role has been activated, the property is read only. 
     * @return string
     */
    public function getRoleTemplateId()
    {
        if (!$this->isPropertyAvailable("RoleTemplateId")) {
            return null;
        }
        return $this->getProperty("RoleTemplateId");
    }
    /**
     *  The **id** of the [directoryRoleTemplate](directoryroletemplate.md) that this role is based on. The property must be specified when activating a directory role in a tenant with a POST operation. After the directory role has been activated, the property is read only. 
     * @var string
     */
    public function setRoleTemplateId($value)
    {
        $this->setProperty("RoleTemplateId", $value, true);
    }
}