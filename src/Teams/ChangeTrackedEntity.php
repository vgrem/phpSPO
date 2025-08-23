<?php

/**
 *  2025-08-22T05:41:05+00:00 
 */
namespace Office365\Teams;

use Office365\Directory\Identities\IdentitySet;
use Office365\Entity;
class ChangeTrackedEntity extends Entity
{
    /**
     * @return IdentitySet
     */
    public function getLastModifiedBy()
    {
        return $this->getProperty("LastModifiedBy");
    }
    /**
     * @var IdentitySet
     */
    public function setLastModifiedBy($value)
    {
        return $this->setProperty("LastModifiedBy", $value, true);
    }
}