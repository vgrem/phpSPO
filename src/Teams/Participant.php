<?php

/**
 *  2025-08-22T05:41:05+00:00 
 */
namespace Office365\Teams;

use Office365\Communications\ParticipantInfo;
use Office365\Communications\RecordingInfo;
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
    /**
     * @return RecordingInfo
     */
    public function getRecordingInfo()
    {
        return $this->getProperty("RecordingInfo");
    }
    /**
     * @var RecordingInfo
     */
    public function setRecordingInfo($value)
    {
        return $this->setProperty("RecordingInfo", $value, true);
    }
}