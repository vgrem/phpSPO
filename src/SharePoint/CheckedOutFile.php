<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T17:00:44+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
/**
 * Represents 
 * a checked-out file in a document library or workspace.
 */
class CheckedOutFile extends ClientObject
{
    /**
     * @return integer
     */
    public function getCheckedOutById()
    {
        if (!$this->isPropertyAvailable("CheckedOutById")) {
            return null;
        }
        return $this->getProperty("CheckedOutById");
    }
    /**
     * @var integer
     */
    public function setCheckedOutById($value)
    {
        $this->setProperty("CheckedOutById", $value, true);
    }
    /**
     * @return User
     */
    public function getCheckedOutBy()
    {
        if (!$this->isPropertyAvailable("CheckedOutBy")) {
            $this->setProperty("CheckedOutBy", new User($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "CheckedOutBy")));
        }
        return $this->getProperty("CheckedOutBy");
    }
}