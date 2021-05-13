<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

class LocalizedNotificationMessage extends ClientObject
{
    /**
     * @return string
     */
    public function getLocale()
    {
        if (!$this->isPropertyAvailable("Locale")) {
            return null;
        }
        return $this->getProperty("Locale");
    }
    /**
     * @var string
     */
    public function setLocale($value)
    {
        $this->setProperty("Locale", $value, true);
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
    public function getMessageTemplate()
    {
        if (!$this->isPropertyAvailable("MessageTemplate")) {
            return null;
        }
        return $this->getProperty("MessageTemplate");
    }
    /**
     * @var string
     */
    public function setMessageTemplate($value)
    {
        $this->setProperty("MessageTemplate", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsDefault()
    {
        if (!$this->isPropertyAvailable("IsDefault")) {
            return null;
        }
        return $this->getProperty("IsDefault");
    }
    /**
     * @var bool
     */
    public function setIsDefault($value)
    {
        $this->setProperty("IsDefault", $value, true);
    }
}