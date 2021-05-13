<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
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
        if (!$this->isPropertyAvailable("AppleIdentifier")) {
            return null;
        }
        return $this->getProperty("AppleIdentifier");
    }
    /**
     * @var string
     */
    public function setAppleIdentifier($value)
    {
        $this->setProperty("AppleIdentifier", $value, true);
    }
    /**
     * @return string
     */
    public function getTopicIdentifier()
    {
        if (!$this->isPropertyAvailable("TopicIdentifier")) {
            return null;
        }
        return $this->getProperty("TopicIdentifier");
    }
    /**
     * @var string
     */
    public function setTopicIdentifier($value)
    {
        $this->setProperty("TopicIdentifier", $value, true);
    }
    /**
     * @return string
     */
    public function getCertificate()
    {
        if (!$this->isPropertyAvailable("Certificate")) {
            return null;
        }
        return $this->getProperty("Certificate");
    }
    /**
     * @var string
     */
    public function setCertificate($value)
    {
        $this->setProperty("Certificate", $value, true);
    }
}