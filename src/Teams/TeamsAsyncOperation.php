<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\Teams;


use Office365\Entity;

class TeamsAsyncOperation extends Entity
{
    /**
     * @return integer
     */
    public function getAttemptsCount()
    {
        return $this->getProperty("AttemptsCount");
    }
    /**
     * @var integer
     */
    public function setAttemptsCount($value)
    {
        $this->setProperty("AttemptsCount", $value, true);
    }
    /**
     * @return string
     */
    public function getTargetResourceId()
    {
        return $this->getProperty("TargetResourceId");
    }
    /**
     * @var string
     */
    public function setTargetResourceId($value)
    {
        $this->setProperty("TargetResourceId", $value, true);
    }
    /**
     * @return string
     */
    public function getTargetResourceLocation()
    {
        return $this->getProperty("TargetResourceLocation");
    }
    /**
     * @var string
     */
    public function setTargetResourceLocation($value)
    {
        $this->setProperty("TargetResourceLocation", $value, true);
    }
    /**
     * @return OperationError
     */
    public function getError()
    {
        return $this->getProperty("Error", new OperationError());
    }
    /**
     * @var OperationError
     */
    public function setError($value)
    {
        $this->setProperty("Error", $value, true);
    }
}