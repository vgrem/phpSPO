<?php

/**
 *  2025-08-22T05:37:38+00:00 
 */
namespace Office365\Intune;

use Office365\Entity;

class MobileLobApp extends Entity
{
    /**
     * @return string
     */
    public function getCommittedContentVersion()
    {
        return $this->getProperty("CommittedContentVersion");
    }
    /**
     * @var string
     */
    public function setCommittedContentVersion($value)
    {
        return $this->setProperty("CommittedContentVersion", $value, true);
    }
    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->getProperty("FileName");
    }
    /**
     * @var string
     */
    public function setFileName($value)
    {
        return $this->setProperty("FileName", $value, true);
    }
    /**
     * @return integer
     */
    public function getSize()
    {
        return $this->getProperty("Size");
    }
    /**
     * @var integer
     */
    public function setSize($value)
    {
        return $this->setProperty("Size", $value, true);
    }
}