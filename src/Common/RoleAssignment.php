<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00
 */
namespace Office365\Common;


use Office365\Entity;
use Office365\Runtime\ResourcePath;
class RoleAssignment extends Entity
{
    /**
     * @return string
     */
    public function getDisplayName()
    {
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
     * @return array
     */
    public function getResourceScopes()
    {
        return $this->getProperty("ResourceScopes");
    }
    /**
     * @var array
     */
    public function setResourceScopes($value)
    {
        $this->setProperty("ResourceScopes", $value, true);
    }
    /**
     * @return RoleDefinition
     */
    public function getRoleDefinition()
    {
        return $this->getProperty("RoleDefinition",
            new RoleDefinition($this->getContext(),
                new ResourcePath("RoleDefinition", $this->getResourcePath())));
    }
}