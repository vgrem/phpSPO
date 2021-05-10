<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Teams;

use Office365\Entity;

/**
 *  "An app in the Microsoft Teams app catalog."
 */
class TeamsApp extends Entity
{
    /**
     * @return string
     */
    public function getExternalId()
    {
        if (!$this->isPropertyAvailable("ExternalId")) {
            return null;
        }
        return $this->getProperty("ExternalId");
    }
    /**
     * @var string
     */
    public function setExternalId($value)
    {
        $this->setProperty("ExternalId", $value, true);
    }
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
}