<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00
 */
namespace Office365\Intune;

use Office365\Runtime\ClientObject;

class ManagedMobileApp extends ClientObject
{
    /**
     * @return string
     */
    public function getVersion()
    {
        if (!$this->isPropertyAvailable("Version")) {
            return null;
        }
        return $this->getProperty("Version");
    }
    /**
     * @var string
     */
    public function setVersion($value)
    {
        $this->setProperty("Version", $value, true);
    }
    /**
     * @return MobileAppIdentifier
     */
    public function getMobileAppIdentifier()
    {
        if (!$this->isPropertyAvailable("MobileAppIdentifier")) {
            return null;
        }
        return $this->getProperty("MobileAppIdentifier");
    }
    /**
     * @var MobileAppIdentifier
     */
    public function setMobileAppIdentifier($value)
    {
        $this->setProperty("MobileAppIdentifier", $value, true);
    }
}