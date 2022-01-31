<?php

/**
 * Generated 2022-01-31T19:42:54+02:00 16.0.22112.12004
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientObject;
use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\Actions\UpdateEntityQuery;
class UserExperienceState extends BaseEntity
{
    /**
     * @return integer
     */
    public function getFlags()
    {
        return $this->getProperty("Flags");
    }
    /**
     * @var integer
     */
    public function setFlags($value)
    {
        return $this->setProperty("Flags", $value, true);
    }
}