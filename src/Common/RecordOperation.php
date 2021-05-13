<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

class RecordOperation extends ClientObject
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