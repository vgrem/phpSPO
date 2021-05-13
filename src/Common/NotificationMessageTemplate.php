<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Common;

use Office365\Entity;


class NotificationMessageTemplate extends Entity
{
    /**
     * @return string
     */
    public function getDisplayName()
    {
        if (!$this->isPropertyAvailable("DisplayName")) {
            return null;
        }
        return $this->getProperty("DisplayName");
    }
    /**
     * @var string
     */
    public function setDisplayName($value)
    {
        $this->setProperty("DisplayName", $value, true);
    }
    /**
     * @return string
     */
    public function getDefaultLocale()
    {
        if (!$this->isPropertyAvailable("DefaultLocale")) {
            return null;
        }
        return $this->getProperty("DefaultLocale");
    }
    /**
     * @var string
     */
    public function setDefaultLocale($value)
    {
        $this->setProperty("DefaultLocale", $value, true);
    }
}