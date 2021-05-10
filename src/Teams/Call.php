<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\Teams;

use Office365\Entity;
use Office365\Common\MediaConfig;
use Office365\Common\ParticipantInfo;
use Office365\Common\ResultInfo;


/**
 *  "The **call** resource is created when there is an incoming call for the application or the application creates a new outgoing call via a `POST` on `app/calls`."
 */
class Call extends Entity
{
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
    public function getCallbackUri()
    {
        if (!$this->isPropertyAvailable("CallbackUri")) {
            return null;
        }
        return $this->getProperty("CallbackUri");
    }
    /**
     * @var string
     */
    public function setCallbackUri($value)
    {
        $this->setProperty("CallbackUri", $value, true);
    }
    /**
     * @return string
     */
    public function getTenantId()
    {
        if (!$this->isPropertyAvailable("TenantId")) {
            return null;
        }
        return $this->getProperty("TenantId");
    }
    /**
     * @var string
     */
    public function setTenantId($value)
    {
        $this->setProperty("TenantId", $value, true);
    }
    /**
     * @return string
     */
    public function getMyParticipantId()
    {
        if (!$this->isPropertyAvailable("MyParticipantId")) {
            return null;
        }
        return $this->getProperty("MyParticipantId");
    }
    /**
     * @var string
     */
    public function setMyParticipantId($value)
    {
        $this->setProperty("MyParticipantId", $value, true);
    }
    /**
     * @return CallMediaState
     */
    public function getMediaState()
    {
        if (!$this->isPropertyAvailable("MediaState")) {
            return null;
        }
        return $this->getProperty("MediaState");
    }
    /**
     * @var CallMediaState
     */
    public function setMediaState($value)
    {
        $this->setProperty("MediaState", $value, true);
    }
    /**
     * @return ResultInfo
     */
    public function getResultInfo()
    {
        if (!$this->isPropertyAvailable("ResultInfo")) {
            return null;
        }
        return $this->getProperty("ResultInfo");
    }
    /**
     * @var ResultInfo
     */
    public function setResultInfo($value)
    {
        $this->setProperty("ResultInfo", $value, true);
    }
    /**
     * @return ParticipantInfo
     */
    public function getSource()
    {
        if (!$this->isPropertyAvailable("Source")) {
            return null;
        }
        return $this->getProperty("Source");
    }
    /**
     * @var ParticipantInfo
     */
    public function setSource($value)
    {
        $this->setProperty("Source", $value, true);
    }
    /**
     * @return MediaConfig
     */
    public function getMediaConfig()
    {
        if (!$this->isPropertyAvailable("MediaConfig")) {
            return null;
        }
        return $this->getProperty("MediaConfig");
    }
    /**
     * @var MediaConfig
     */
    public function setMediaConfig($value)
    {
        $this->setProperty("MediaConfig", $value, true);
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
    /**
     * @return CallOptions
     */
    public function getCallOptions()
    {
        if (!$this->isPropertyAvailable("CallOptions")) {
            return null;
        }
        return $this->getProperty("CallOptions");
    }
    /**
     * @var CallOptions
     */
    public function setCallOptions($value)
    {
        $this->setProperty("CallOptions", $value, true);
    }
    /**
     * @return MeetingInfo
     */
    public function getMeetingInfo()
    {
        if (!$this->isPropertyAvailable("MeetingInfo")) {
            return null;
        }
        return $this->getProperty("MeetingInfo");
    }
    /**
     * @var MeetingInfo
     */
    public function setMeetingInfo($value)
    {
        $this->setProperty("MeetingInfo", $value, true);
    }
    /**
     * @return ToneInfo
     */
    public function getToneInfo()
    {
        if (!$this->isPropertyAvailable("ToneInfo")) {
            return null;
        }
        return $this->getProperty("ToneInfo");
    }
    /**
     * @var ToneInfo
     */
    public function setToneInfo($value)
    {
        $this->setProperty("ToneInfo", $value, true);
    }
    /**
     * @return string
     */
    public function getCallChainId()
    {
        if (!$this->isPropertyAvailable("CallChainId")) {
            return null;
        }
        return $this->getProperty("CallChainId");
    }
    /**
     * @var string
     */
    public function setCallChainId($value)
    {
        $this->setProperty("CallChainId", $value, true);
    }
}