<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\Teams;

use Office365\Entity;

class ScheduleChangeRequest extends Entity
{
    /**
     * @return string
     */
    public function getSenderMessage()
    {
        if (!$this->isPropertyAvailable("SenderMessage")) {
            return null;
        }
        return $this->getProperty("SenderMessage");
    }
    /**
     * @var string
     */
    public function setSenderMessage($value)
    {
        $this->setProperty("SenderMessage", $value, true);
    }
    /**
     * @return string
     */
    public function getManagerActionMessage()
    {
        if (!$this->isPropertyAvailable("ManagerActionMessage")) {
            return null;
        }
        return $this->getProperty("ManagerActionMessage");
    }
    /**
     * @var string
     */
    public function setManagerActionMessage($value)
    {
        $this->setProperty("ManagerActionMessage", $value, true);
    }
    /**
     * @return string
     */
    public function getSenderUserId()
    {
        if (!$this->isPropertyAvailable("SenderUserId")) {
            return null;
        }
        return $this->getProperty("SenderUserId");
    }
    /**
     * @var string
     */
    public function setSenderUserId($value)
    {
        $this->setProperty("SenderUserId", $value, true);
    }
    /**
     * @return string
     */
    public function getManagerUserId()
    {
        if (!$this->isPropertyAvailable("ManagerUserId")) {
            return null;
        }
        return $this->getProperty("ManagerUserId");
    }
    /**
     * @var string
     */
    public function setManagerUserId($value)
    {
        $this->setProperty("ManagerUserId", $value, true);
    }
}