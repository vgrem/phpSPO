<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Teams;

use Office365\Entity;

class TeamsAppDefinition extends Entity
{
    /**
     * @return string
     */
    public function getTeamsAppId()
    {
        if (!$this->isPropertyAvailable("TeamsAppId")) {
            return null;
        }
        return $this->getProperty("TeamsAppId");
    }
    /**
     * @var string
     */
    public function setTeamsAppId($value)
    {
        $this->setProperty("TeamsAppId", $value, true);
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
    /**
     * @return string
     */
    public function getVersion()
    {
        if (!$this->isPropertyAvailable("Version")) {
            return null;
        }
        return $this->getProperty("Version");
    }
    /**
     * @var string
     */
    public function setVersion($value)
    {
        $this->setProperty("Version", $value, true);
    }
}