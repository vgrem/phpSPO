<?php

/**
 * Modified: 2020-05-25T06:42:59+00:00
 */
namespace Office365\OneDrive;

use Office365\Common\IdentitySet;
use Office365\Entity;


class BaseItemVersion extends Entity
{
    /**
     * @return IdentitySet
     */
    public function getLastModifiedBy()
    {
        return $this->getProperty("LastModifiedBy", new IdentitySet());
    }

    /**
     *
     * @return self
     * @var IdentitySet
     */
    public function setLastModifiedBy($value)
    {
        return $this->setProperty("LastModifiedBy", $value, true);
    }
    /**
     * @return PublicationFacet
     */
    public function getPublication()
    {
        return $this->getProperty("Publication", new PublicationFacet());
    }

    /**
     *
     * @return self
     * @var PublicationFacet
     */
    public function setPublication($value)
    {
        return $this->setProperty("Publication", $value, true);
    }
}