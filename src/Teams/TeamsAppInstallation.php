<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\Teams;

use Office365\Entity;
use Office365\Runtime\ResourcePath;
/**
 * A [teamsApp](teamsapp.md) installed in a [team](team.md). Any bots that are part of the app will become part of any team the app is added to.
 */
class TeamsAppInstallation extends Entity
{
    /**
     *  The app that is installed. 
     * @return TeamsApp
     */
    public function getTeamsApp()
    {
        if (!$this->isPropertyAvailable("TeamsApp")) {
            $this->setProperty("TeamsApp", new TeamsApp($this->getContext(), new ResourcePath("TeamsApp", $this->getResourcePath())));
        }
        return $this->getProperty("TeamsApp");
    }
    /**
     *  The details of this version of the app. 
     * @return TeamsAppDefinition
     */
    public function getTeamsAppDefinition()
    {
        if (!$this->isPropertyAvailable("TeamsAppDefinition")) {
            $this->setProperty("TeamsAppDefinition", new TeamsAppDefinition($this->getContext(), new ResourcePath("TeamsAppDefinition", $this->getResourcePath())));
        }
        return $this->getProperty("TeamsAppDefinition");
    }
}