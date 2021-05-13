<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Entity;

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
}