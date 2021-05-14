<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\OneDrive;

use Office365\Common\AccessAction;
use Office365\Entity;

use Office365\Common\IdentitySet;
use Office365\Runtime\ResourcePath;
class ItemActivity extends Entity
{
    /**
     * @return IdentitySet
     */
    public function getActor()
    {
        if (!$this->isPropertyAvailable("Actor")) {
            return null;
        }
        return $this->getProperty("Actor");
    }
    /**
     * @var IdentitySet
     */
    public function setActor($value)
    {
        $this->setProperty("Actor", $value, true);
    }
    /**
     * @return DriveItem
     */
    public function getDriveItem()
    {
        if (!$this->isPropertyAvailable("DriveItem")) {
            $this->setProperty("DriveItem", new DriveItem($this->getContext(), new ResourcePath("DriveItem", $this->getResourcePath())));
        }
        return $this->getProperty("DriveItem");
    }
    /**
     * @return AccessAction
     */
    public function getAccess()
    {
        if (!$this->isPropertyAvailable("Access")) {
            return null;
        }
        return $this->getProperty("Access");
    }
    /**
     * @var AccessAction
     */
    public function setAccess($value)
    {
        $this->setProperty("Access", $value, true);
    }
}