<?php

/**
 *  2025-08-22T05:38:57+00:00 
 */
namespace Office365\Intune;

use Office365\Directory\Applications\MimeContent;
use Office365\Entity;
use Office365\Runtime\ResourcePath;

class ManagedEBook extends Entity
{
    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->getProperty("DisplayName");
    }
    /**
     * @var string
     */
    public function setDisplayName($value)
    {
        return $this->setProperty("DisplayName", $value, true);
    }
    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->getProperty("Description");
    }
    /**
     * @var string
     */
    public function setDescription($value)
    {
        return $this->setProperty("Description", $value, true);
    }
    /**
     * @return string
     */
    public function getPublisher()
    {
        return $this->getProperty("Publisher");
    }
    /**
     * @var string
     */
    public function setPublisher($value)
    {
        return $this->setProperty("Publisher", $value, true);
    }
    /**
     * @return MimeContent
     */
    public function getLargeCover()
    {
        return $this->getProperty("LargeCover");
    }
    /**
     * @var MimeContent
     */
    public function setLargeCover($value)
    {
        return $this->setProperty("LargeCover", $value, true);
    }
    /**
     * @return string
     */
    public function getInformationUrl()
    {
        return $this->getProperty("InformationUrl");
    }
    /**
     * @var string
     */
    public function setInformationUrl($value)
    {
        return $this->setProperty("InformationUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getPrivacyInformationUrl()
    {
        return $this->getProperty("PrivacyInformationUrl");
    }
    /**
     * @var string
     */
    public function setPrivacyInformationUrl($value)
    {
        return $this->setProperty("PrivacyInformationUrl", $value, true);
    }
    /**
     * @return EBookInstallSummary
     */
    public function getInstallSummary()
    {
        return $this->getProperty("InstallSummary", new EBookInstallSummary($this->getContext(), new ResourcePath("InstallSummary", $this->getResourcePath())));
    }
}