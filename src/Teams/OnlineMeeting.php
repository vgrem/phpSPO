<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\Teams;

use Office365\Entity;

/**
 * Contains information about the meeting, including the URL used to join a meeting, the attendees list, and the description.
 */
class OnlineMeeting extends Entity
{
    /**
     * @return string
     */
    public function getJoinWebUrl()
    {
        if (!$this->isPropertyAvailable("JoinWebUrl")) {
            return null;
        }
        return $this->getProperty("JoinWebUrl");
    }
    /**
     * @var string
     */
    public function setJoinWebUrl($value)
    {
        $this->setProperty("JoinWebUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getSubject()
    {
        if (!$this->isPropertyAvailable("Subject")) {
            return null;
        }
        return $this->getProperty("Subject");
    }
    /**
     * @var string
     */
    public function setSubject($value)
    {
        $this->setProperty("Subject", $value, true);
    }
    /**
     * @return string
     */
    public function getVideoTeleconferenceId()
    {
        if (!$this->isPropertyAvailable("VideoTeleconferenceId")) {
            return null;
        }
        return $this->getProperty("VideoTeleconferenceId");
    }
    /**
     * @var string
     */
    public function setVideoTeleconferenceId($value)
    {
        $this->setProperty("VideoTeleconferenceId", $value, true);
    }
    /**
     * @return MeetingParticipants
     */
    public function getParticipants()
    {
        if (!$this->isPropertyAvailable("Participants")) {
            return null;
        }
        return $this->getProperty("Participants");
    }
    /**
     * @var MeetingParticipants
     */
    public function setParticipants($value)
    {
        $this->setProperty("Participants", $value, true);
    }
    /**
     * @return AudioConferencing
     */
    public function getAudioConferencing()
    {
        if (!$this->isPropertyAvailable("AudioConferencing")) {
            return null;
        }
        return $this->getProperty("AudioConferencing");
    }
    /**
     * @var AudioConferencing
     */
    public function setAudioConferencing($value)
    {
        $this->setProperty("AudioConferencing", $value, true);
    }
    /**
     * @return ChatInfo
     */
    public function getChatInfo()
    {
        if (!$this->isPropertyAvailable("ChatInfo")) {
            return null;
        }
        return $this->getProperty("ChatInfo");
    }
    /**
     * @var ChatInfo
     */
    public function setChatInfo($value)
    {
        $this->setProperty("ChatInfo", $value, true);
    }
}