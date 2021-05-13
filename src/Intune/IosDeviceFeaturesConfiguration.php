<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Intune;

use Office365\Runtime\ClientObject;

class IosDeviceFeaturesConfiguration extends ClientObject
{
    /**
     * @return string
     */
    public function getAssetTagTemplate()
    {
        if (!$this->isPropertyAvailable("AssetTagTemplate")) {
            return null;
        }
        return $this->getProperty("AssetTagTemplate");
    }
    /**
     * @var string
     */
    public function setAssetTagTemplate($value)
    {
        $this->setProperty("AssetTagTemplate", $value, true);
    }
    /**
     * @return string
     */
    public function getLockScreenFootnote()
    {
        if (!$this->isPropertyAvailable("LockScreenFootnote")) {
            return null;
        }
        return $this->getProperty("LockScreenFootnote");
    }
    /**
     * @var string
     */
    public function setLockScreenFootnote($value)
    {
        $this->setProperty("LockScreenFootnote", $value, true);
    }
}