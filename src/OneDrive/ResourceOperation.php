<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\OneDrive;

use Office365\Entity;

class ResourceOperation extends Entity
{
    /**
     * @return string
     */
    public function getResourceName()
    {
        if (!$this->isPropertyAvailable("ResourceName")) {
            return null;
        }
        return $this->getProperty("ResourceName");
    }
    /**
     * @var string
     */
    public function setResourceName($value)
    {
        $this->setProperty("ResourceName", $value, true);
    }
    /**
     * @return string
     */
    public function getActionName()
    {
        if (!$this->isPropertyAvailable("ActionName")) {
            return null;
        }
        return $this->getProperty("ActionName");
    }
    /**
     * @var string
     */
    public function setActionName($value)
    {
        $this->setProperty("ActionName", $value, true);
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
}