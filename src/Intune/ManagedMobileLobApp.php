<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Intune;

use Office365\Entity;

class ManagedMobileLobApp extends Entity
{
    /**
     * @return string
     */
    public function getCommittedContentVersion()
    {
        if (!$this->isPropertyAvailable("CommittedContentVersion")) {
            return null;
        }
        return $this->getProperty("CommittedContentVersion");
    }
    /**
     * @var string
     */
    public function setCommittedContentVersion($value)
    {
        $this->setProperty("CommittedContentVersion", $value, true);
    }
    /**
     * @return string
     */
    public function getFileName()
    {
        if (!$this->isPropertyAvailable("FileName")) {
            return null;
        }
        return $this->getProperty("FileName");
    }
    /**
     * @var string
     */
    public function setFileName($value)
    {
        $this->setProperty("FileName", $value, true);
    }
    /**
     * @return integer
     */
    public function getSize()
    {
        if (!$this->isPropertyAvailable("Size")) {
            return null;
        }
        return $this->getProperty("Size");
    }
    /**
     * @var integer
     */
    public function setSize($value)
    {
        $this->setProperty("Size", $value, true);
    }
}