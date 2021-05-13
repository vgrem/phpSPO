<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Intune;

use Office365\Runtime\ClientObject;

class IosMobileAppConfiguration extends ClientObject
{
    /**
     * @return string
     */
    public function getEncodedSettingXml()
    {
        if (!$this->isPropertyAvailable("EncodedSettingXml")) {
            return null;
        }
        return $this->getProperty("EncodedSettingXml");
    }
    /**
     * @var string
     */
    public function setEncodedSettingXml($value)
    {
        $this->setProperty("EncodedSettingXml", $value, true);
    }
}