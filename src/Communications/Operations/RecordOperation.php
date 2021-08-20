<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Communications\Operations;

use Office365\Entity;

class RecordOperation extends Entity
{
    /**
     * @return string
     */
    public function getRecordingLocation()
    {
        if (!$this->isPropertyAvailable("RecordingLocation")) {
            return null;
        }
        return $this->getProperty("RecordingLocation");
    }
    /**
     * @var string
     */
    public function setRecordingLocation($value)
    {
        $this->setProperty("RecordingLocation", $value, true);
    }
    /**
     * @return string
     */
    public function getRecordingAccessToken()
    {
        if (!$this->isPropertyAvailable("RecordingAccessToken")) {
            return null;
        }
        return $this->getProperty("RecordingAccessToken");
    }
    /**
     * @var string
     */
    public function setRecordingAccessToken($value)
    {
        $this->setProperty("RecordingAccessToken", $value, true);
    }
}