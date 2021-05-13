<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00
 */
namespace Office365\Intune;

use Office365\Entity;

class DeviceAppManagement extends Entity
{
    /**
     * @return bool
     */
    public function getIsEnabledForMicrosoftStoreForBusiness()
    {
        if (!$this->isPropertyAvailable("IsEnabledForMicrosoftStoreForBusiness")) {
            return null;
        }
        return $this->getProperty("IsEnabledForMicrosoftStoreForBusiness");
    }
    /**
     * @var bool
     */
    public function setIsEnabledForMicrosoftStoreForBusiness($value)
    {
        $this->setProperty("IsEnabledForMicrosoftStoreForBusiness", $value, true);
    }
    /**
     * @return string
     */
    public function getMicrosoftStoreForBusinessLanguage()
    {
        if (!$this->isPropertyAvailable("MicrosoftStoreForBusinessLanguage")) {
            return null;
        }
        return $this->getProperty("MicrosoftStoreForBusinessLanguage");
    }
    /**
     * @var string
     */
    public function setMicrosoftStoreForBusinessLanguage($value)
    {
        $this->setProperty("MicrosoftStoreForBusinessLanguage", $value, true);
    }
}