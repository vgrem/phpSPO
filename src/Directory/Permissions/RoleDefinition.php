<?php

/**
 *  2025-08-22T05:38:57+00:00 
 */
namespace Office365\Directory\Permissions;

use Office365\Entity;
use Office365\Runtime\ResourcePath;
use Office365\SharePoint\RoleAssignmentCollection;

class RoleDefinition extends Entity
{
    /**
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
     * @var string
     */
    public function setDisplayName($value)
    {
        $this->setProperty("DisplayName", $value, true);
    }
    /**
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
     * @var string
     */
    public function setDescription($value)
    {
        $this->setProperty("Description", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsBuiltIn()
    {
        if (!$this->isPropertyAvailable("IsBuiltIn")) {
            return null;
        }
        return $this->getProperty("IsBuiltIn");
    }
    /**
     * @var bool
     */
    public function setIsBuiltIn($value)
    {
        $this->setProperty("IsBuiltIn", $value, true);
    }
    /**
     * @return RoleAssignmentCollection
     */
    public function getRoleAssignments()
    {
        return $this->getProperty("RoleAssignments", new RoleAssignmentCollection($this->getContext(), new ResourcePath("RoleAssignments", $this->getResourcePath())));
    }
}