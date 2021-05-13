<?php

/**
 * Modified: 2020-05-25T06:42:59+00:00
 */
namespace Office365\Common;

use Office365\Entity;

/**
 *  " create and delete are not supported. Inherits from directoryObject."
 */
class Organization extends Entity
{
    /**
     * @return array
     */
    public function getBusinessPhones()
    {
        if (!$this->isPropertyAvailable("BusinessPhones")) {
            return null;
        }
        return $this->getProperty("BusinessPhones");
    }
    /**
     * @var array
     */
    public function setBusinessPhones($value)
    {
        $this->setProperty("BusinessPhones", $value, true);
    }
    /**
     * @return string
     */
    public function getCity()
    {
        if (!$this->isPropertyAvailable("City")) {
            return null;
        }
        return $this->getProperty("City");
    }
    /**
     * @var string
     */
    public function setCity($value)
    {
        $this->setProperty("City", $value, true);
    }
    /**
     * @return string
     */
    public function getCountry()
    {
        if (!$this->isPropertyAvailable("Country")) {
            return null;
        }
        return $this->getProperty("Country");
    }
    /**
     * @var string
     */
    public function setCountry($value)
    {
        $this->setProperty("Country", $value, true);
    }
    /**
     * @return string
     */
    public function getCountryLetterCode()
    {
        if (!$this->isPropertyAvailable("CountryLetterCode")) {
            return null;
        }
        return $this->getProperty("CountryLetterCode");
    }
    /**
     * @var string
     */
    public function setCountryLetterCode($value)
    {
        $this->setProperty("CountryLetterCode", $value, true);
    }
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
     * @return array
     */
    public function getMarketingNotificationEmails()
    {
        if (!$this->isPropertyAvailable("MarketingNotificationEmails")) {
            return null;
        }
        return $this->getProperty("MarketingNotificationEmails");
    }
    /**
     * @var array
     */
    public function setMarketingNotificationEmails($value)
    {
        $this->setProperty("MarketingNotificationEmails", $value, true);
    }
    /**
     * @return bool
     */
    public function getOnPremisesSyncEnabled()
    {
        if (!$this->isPropertyAvailable("OnPremisesSyncEnabled")) {
            return null;
        }
        return $this->getProperty("OnPremisesSyncEnabled");
    }
    /**
     * @var bool
     */
    public function setOnPremisesSyncEnabled($value)
    {
        $this->setProperty("OnPremisesSyncEnabled", $value, true);
    }
    /**
     * @return string
     */
    public function getPostalCode()
    {
        if (!$this->isPropertyAvailable("PostalCode")) {
            return null;
        }
        return $this->getProperty("PostalCode");
    }
    /**
     * @var string
     */
    public function setPostalCode($value)
    {
        $this->setProperty("PostalCode", $value, true);
    }
    /**
     * @return string
     */
    public function getPreferredLanguage()
    {
        if (!$this->isPropertyAvailable("PreferredLanguage")) {
            return null;
        }
        return $this->getProperty("PreferredLanguage");
    }
    /**
     * @var string
     */
    public function setPreferredLanguage($value)
    {
        $this->setProperty("PreferredLanguage", $value, true);
    }
    /**
     * @return array
     */
    public function getSecurityComplianceNotificationMails()
    {
        if (!$this->isPropertyAvailable("SecurityComplianceNotificationMails")) {
            return null;
        }
        return $this->getProperty("SecurityComplianceNotificationMails");
    }
    /**
     * @var array
     */
    public function setSecurityComplianceNotificationMails($value)
    {
        $this->setProperty("SecurityComplianceNotificationMails", $value, true);
    }
    /**
     * @return array
     */
    public function getSecurityComplianceNotificationPhones()
    {
        if (!$this->isPropertyAvailable("SecurityComplianceNotificationPhones")) {
            return null;
        }
        return $this->getProperty("SecurityComplianceNotificationPhones");
    }
    /**
     * @var array
     */
    public function setSecurityComplianceNotificationPhones($value)
    {
        $this->setProperty("SecurityComplianceNotificationPhones", $value, true);
    }
    /**
     * @return string
     */
    public function getState()
    {
        if (!$this->isPropertyAvailable("State")) {
            return null;
        }
        return $this->getProperty("State");
    }
    /**
     * @var string
     */
    public function setState($value)
    {
        $this->setProperty("State", $value, true);
    }
    /**
     * @return string
     */
    public function getStreet()
    {
        if (!$this->isPropertyAvailable("Street")) {
            return null;
        }
        return $this->getProperty("Street");
    }
    /**
     * @var string
     */
    public function setStreet($value)
    {
        $this->setProperty("Street", $value, true);
    }
    /**
     * @return array
     */
    public function getTechnicalNotificationMails()
    {
        if (!$this->isPropertyAvailable("TechnicalNotificationMails")) {
            return null;
        }
        return $this->getProperty("TechnicalNotificationMails");
    }
    /**
     * @var array
     */
    public function setTechnicalNotificationMails($value)
    {
        $this->setProperty("TechnicalNotificationMails", $value, true);
    }
    /**
     * @return PrivacyProfile
     */
    public function getPrivacyProfile()
    {
        if (!$this->isPropertyAvailable("PrivacyProfile")) {
            return null;
        }
        return $this->getProperty("PrivacyProfile");
    }
    /**
     * @var PrivacyProfile
     */
    public function setPrivacyProfile($value)
    {
        $this->setProperty("PrivacyProfile", $value, true);
    }
}