<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Intune;

use Office365\Runtime\ClientObject;

class WindowsInformationProtectionNetworkLearningSummary extends ClientObject
{
    /**
     * @return string
     */
    public function getUrl()
    {
        if (!$this->isPropertyAvailable("Url")) {
            return null;
        }
        return $this->getProperty("Url");
    }
    /**
     * @var string
     */
    public function setUrl($value)
    {
        $this->setProperty("Url", $value, true);
    }
    /**
     * @return integer
     */
    public function getDeviceCount()
    {
        if (!$this->isPropertyAvailable("DeviceCount")) {
            return null;
        }
        return $this->getProperty("DeviceCount");
    }
    /**
     * @var integer
     */
    public function setDeviceCount($value)
    {
        $this->setProperty("DeviceCount", $value, true);
    }
}