<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00
 */
namespace Office365\Intune;

use Office365\Runtime\ClientObject;

class ManagedAndroidLobApp extends ClientObject
{
    /**
     * @return string
     */
    public function getPackageId()
    {
        if (!$this->isPropertyAvailable("PackageId")) {
            return null;
        }
        return $this->getProperty("PackageId");
    }
    /**
     * @var string
     */
    public function setPackageId($value)
    {
        $this->setProperty("PackageId", $value, true);
    }
    /**
     * @return string
     */
    public function getVersionName()
    {
        if (!$this->isPropertyAvailable("VersionName")) {
            return null;
        }
        return $this->getProperty("VersionName");
    }
    /**
     * @var string
     */
    public function setVersionName($value)
    {
        $this->setProperty("VersionName", $value, true);
    }
    /**
     * @return string
     */
    public function getVersionCode()
    {
        if (!$this->isPropertyAvailable("VersionCode")) {
            return null;
        }
        return $this->getProperty("VersionCode");
    }
    /**
     * @var string
     */
    public function setVersionCode($value)
    {
        $this->setProperty("VersionCode", $value, true);
    }
    /**
     * @return AndroidMinimumOperatingSystem
     */
    public function getMinimumSupportedOperatingSystem()
    {
        if (!$this->isPropertyAvailable("MinimumSupportedOperatingSystem")) {
            return null;
        }
        return $this->getProperty("MinimumSupportedOperatingSystem");
    }
    /**
     * @var AndroidMinimumOperatingSystem
     */
    public function setMinimumSupportedOperatingSystem($value)
    {
        $this->setProperty("MinimumSupportedOperatingSystem", $value, true);
    }
}