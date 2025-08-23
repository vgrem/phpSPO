<?php

/**
 *  2025-08-22T05:38:57+00:00 
 */
namespace Office365\Intune;

use Office365\Entity;

class MacOSGeneralDeviceConfiguration extends Entity
{
    /**
     * @return array
     */
    public function getEmailInDomainSuffixes()
    {
        return $this->getProperty("EmailInDomainSuffixes");
    }
    /**
     * @var array
     */
    public function setEmailInDomainSuffixes($value)
    {
        return $this->setProperty("EmailInDomainSuffixes", $value, true);
    }
    /**
     * @return bool
     */
    public function getPasswordBlockSimple()
    {
        return $this->getProperty("PasswordBlockSimple");
    }
    /**
     * @var bool
     */
    public function setPasswordBlockSimple($value)
    {
        return $this->setProperty("PasswordBlockSimple", $value, true);
    }
    /**
     * @return integer
     */
    public function getPasswordExpirationDays()
    {
        return $this->getProperty("PasswordExpirationDays");
    }
    /**
     * @var integer
     */
    public function setPasswordExpirationDays($value)
    {
        return $this->setProperty("PasswordExpirationDays", $value, true);
    }
    /**
     * @return integer
     */
    public function getPasswordMinimumCharacterSetCount()
    {
        return $this->getProperty("PasswordMinimumCharacterSetCount");
    }
    /**
     * @var integer
     */
    public function setPasswordMinimumCharacterSetCount($value)
    {
        return $this->setProperty("PasswordMinimumCharacterSetCount", $value, true);
    }
    /**
     * @return integer
     */
    public function getPasswordMinimumLength()
    {
        return $this->getProperty("PasswordMinimumLength");
    }
    /**
     * @var integer
     */
    public function setPasswordMinimumLength($value)
    {
        return $this->setProperty("PasswordMinimumLength", $value, true);
    }
    /**
     * @return integer
     */
    public function getPasswordMinutesOfInactivityBeforeLock()
    {
        return $this->getProperty("PasswordMinutesOfInactivityBeforeLock");
    }
    /**
     * @var integer
     */
    public function setPasswordMinutesOfInactivityBeforeLock($value)
    {
        return $this->setProperty("PasswordMinutesOfInactivityBeforeLock", $value, true);
    }
    /**
     * @return integer
     */
    public function getPasswordMinutesOfInactivityBeforeScreenTimeout()
    {
        return $this->getProperty("PasswordMinutesOfInactivityBeforeScreenTimeout");
    }
    /**
     * @var integer
     */
    public function setPasswordMinutesOfInactivityBeforeScreenTimeout($value)
    {
        return $this->setProperty("PasswordMinutesOfInactivityBeforeScreenTimeout", $value, true);
    }
    /**
     * @return integer
     */
    public function getPasswordPreviousPasswordBlockCount()
    {
        return $this->getProperty("PasswordPreviousPasswordBlockCount");
    }
    /**
     * @var integer
     */
    public function setPasswordPreviousPasswordBlockCount($value)
    {
        return $this->setProperty("PasswordPreviousPasswordBlockCount", $value, true);
    }
    /**
     * @return bool
     */
    public function getPasswordRequired()
    {
        return $this->getProperty("PasswordRequired");
    }
    /**
     * @var bool
     */
    public function setPasswordRequired($value)
    {
        return $this->setProperty("PasswordRequired", $value, true);
    }
}