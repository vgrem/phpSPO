<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

class VppToken extends ClientObject
{
    /**
     * @return string
     */
    public function getOrganizationName()
    {
        if (!$this->isPropertyAvailable("OrganizationName")) {
            return null;
        }
        return $this->getProperty("OrganizationName");
    }
    /**
     * @var string
     */
    public function setOrganizationName($value)
    {
        $this->setProperty("OrganizationName", $value, true);
    }
    /**
     * @return string
     */
    public function getAppleId()
    {
        if (!$this->isPropertyAvailable("AppleId")) {
            return null;
        }
        return $this->getProperty("AppleId");
    }
    /**
     * @var string
     */
    public function setAppleId($value)
    {
        $this->setProperty("AppleId", $value, true);
    }
    /**
     * @return string
     */
    public function getToken()
    {
        if (!$this->isPropertyAvailable("Token")) {
            return null;
        }
        return $this->getProperty("Token");
    }
    /**
     * @var string
     */
    public function setToken($value)
    {
        $this->setProperty("Token", $value, true);
    }
    /**
     * @return bool
     */
    public function getAutomaticallyUpdateApps()
    {
        if (!$this->isPropertyAvailable("AutomaticallyUpdateApps")) {
            return null;
        }
        return $this->getProperty("AutomaticallyUpdateApps");
    }
    /**
     * @var bool
     */
    public function setAutomaticallyUpdateApps($value)
    {
        $this->setProperty("AutomaticallyUpdateApps", $value, true);
    }
    /**
     * @return string
     */
    public function getCountryOrRegion()
    {
        if (!$this->isPropertyAvailable("CountryOrRegion")) {
            return null;
        }
        return $this->getProperty("CountryOrRegion");
    }
    /**
     * @var string
     */
    public function setCountryOrRegion($value)
    {
        $this->setProperty("CountryOrRegion", $value, true);
    }
}