<?php

/**
 * Modified: 2020-05-24T22:03:02+00:00
 */
namespace Office365\Common;

use Office365\Entity;

class LicenseDetails extends Entity
{
    /**
     * @return string
     */
    public function getSkuId()
    {
        return $this->getProperty("SkuId");
    }
    /**
     * @var string
     */
    public function setSkuId($value)
    {
        $this->setProperty("SkuId", $value, true);
    }
    /**
     * @return string
     */
    public function getSkuPartNumber()
    {
        if (!$this->isPropertyAvailable("SkuPartNumber")) {
            return null;
        }
        return $this->getProperty("SkuPartNumber");
    }
    /**
     * @var string
     */
    public function setSkuPartNumber($value)
    {
        $this->setProperty("SkuPartNumber", $value, true);
    }
}