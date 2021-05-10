<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\Teams;

use Office365\Entity;
use Office365\Runtime\ResourcePath;
/**
 * A teamsTab is a [tab](../resources/teamstab.md) that's pinned (attached) to a [channel](channel.md) within a [team](team.md). 
 */
class TeamsTab extends Entity
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
    public function getWebUrl()
    {
        if (!$this->isPropertyAvailable("WebUrl")) {
            return null;
        }
        return $this->getProperty("WebUrl");
    }
    /**
     * @var string
     */
    public function setWebUrl($value)
    {
        $this->setProperty("WebUrl", $value, true);
    }
    /**
     * @return TeamsTabConfiguration
     */
    public function getConfiguration()
    {
        if (!$this->isPropertyAvailable("Configuration")) {
            return null;
        }
        return $this->getProperty("Configuration");
    }
    /**
     * @var TeamsTabConfiguration
     */
    public function setConfiguration($value)
    {
        $this->setProperty("Configuration", $value, true);
    }
    /**
     *  The application that is linked to the tab. This cannot be changed after tab creation. 
     * @return TeamsApp
     */
    public function getTeamsApp()
    {
        if (!$this->isPropertyAvailable("TeamsApp")) {
            $this->setProperty("TeamsApp", new TeamsApp($this->getContext(), new ResourcePath("TeamsApp", $this->getResourcePath())));
        }
        return $this->getProperty("TeamsApp");
    }
}