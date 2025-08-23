<?php

/**
 *  2025-08-22T05:38:57+00:00 
 */
namespace Office365\Intune;

use Office365\Entity;

class ApplePushNotificationCertificate extends Entity
{
    /**
     * @return string
     */
    public function getAppleIdentifier()
    {
        return $this->getProperty("AppleIdentifier");
    }
    /**
     * @var string
     */
    public function setAppleIdentifier($value)
    {
        return $this->setProperty("AppleIdentifier", $value, true);
    }
    /**
     * @return string
     */
    public function getTopicIdentifier()
    {
        return $this->getProperty("TopicIdentifier");
    }
    /**
     * @var string
     */
    public function setTopicIdentifier($value)
    {
        return $this->setProperty("TopicIdentifier", $value, true);
    }
    /**
     * @return string
     */
    public function getCertificate()
    {
        return $this->getProperty("Certificate");
    }
    /**
     * @var string
     */
    public function setCertificate($value)
    {
        return $this->setProperty("Certificate", $value, true);
    }
}