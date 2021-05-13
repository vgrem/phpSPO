<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

class DomainDnsMxRecord extends ClientObject
{
    /**
     * @return string
     */
    public function getMailExchange()
    {
        if (!$this->isPropertyAvailable("MailExchange")) {
            return null;
        }
        return $this->getProperty("MailExchange");
    }
    /**
     * @var string
     */
    public function setMailExchange($value)
    {
        $this->setProperty("MailExchange", $value, true);
    }
    /**
     * @return integer
     */
    public function getPreference()
    {
        if (!$this->isPropertyAvailable("Preference")) {
            return null;
        }
        return $this->getProperty("Preference");
    }
    /**
     * @var integer
     */
    public function setPreference($value)
    {
        $this->setProperty("Preference", $value, true);
    }
}