<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

class EditionUpgradeConfiguration extends ClientObject
{
    /**
     * @return string
     */
    public function getLicense()
    {
        if (!$this->isPropertyAvailable("License")) {
            return null;
        }
        return $this->getProperty("License");
    }
    /**
     * @var string
     */
    public function setLicense($value)
    {
        $this->setProperty("License", $value, true);
    }
    /**
     * @return string
     */
    public function getProductKey()
    {
        if (!$this->isPropertyAvailable("ProductKey")) {
            return null;
        }
        return $this->getProperty("ProductKey");
    }
    /**
     * @var string
     */
    public function setProductKey($value)
    {
        $this->setProperty("ProductKey", $value, true);
    }
}