<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00
 */
namespace Office365\Teams;

use Office365\Entity;

/**
 * Represents the participant type.
 */
class Participant extends Entity
{
    /**
     * @return bool
     */
    public function getIsMuted()
    {
        if (!$this->isPropertyAvailable("IsMuted")) {
            return null;
        }
        return $this->getProperty("IsMuted");
    }
    /**
     * @var bool
     */
    public function setIsMuted($value)
    {
        $this->setProperty("IsMuted", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsInLobby()
    {
        if (!$this->isPropertyAvailable("IsInLobby")) {
            return null;
        }
        return $this->getProperty("IsInLobby");
    }
    /**
     * @var bool
     */
    public function setIsInLobby($value)
    {
        $this->setProperty("IsInLobby", $value, true);
    }
    /**
     * @return ParticipantInfo
     */
    public function getInfo()
    {
        return $this->getProperty("Info", new ParticipantInfo());
    }
    /**
     * @var ParticipantInfo
     */
    public function setInfo($value)
    {
        $this->setProperty("Info", $value, true);
    }
}