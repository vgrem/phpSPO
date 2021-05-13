<?php

/**
 * Modified: 2020-05-25T06:42:59+00:00
 */
namespace Office365\Common;

use Office365\Entity;


/**
 *  "Contains information about a service SKU that a company is subscribed to."
 */
class SubscribedSku extends Entity
{
    /**
     *   Possible values are: `Enabled`, `Warning`, `Suspended`, `Deleted`, `LockedOut`. 
     * @return string
     */
    public function getCapabilityStatus()
    {
        if (!$this->isPropertyAvailable("CapabilityStatus")) {
            return null;
        }
        return $this->getProperty("CapabilityStatus");
    }
    /**
     *   Possible values are: `Enabled`, `Warning`, `Suspended`, `Deleted`, `LockedOut`. 
     * @var string
     */
    public function setCapabilityStatus($value)
    {
        $this->setProperty("CapabilityStatus", $value, true);
    }
    /**
     *  The number of licenses that have been assigned. 
     * @return integer
     */
    public function getConsumedUnits()
    {
        if (!$this->isPropertyAvailable("ConsumedUnits")) {
            return null;
        }
        return $this->getProperty("ConsumedUnits");
    }
    /**
     *  The number of licenses that have been assigned. 
     * @var integer
     */
    public function setConsumedUnits($value)
    {
        $this->setProperty("ConsumedUnits", $value, true);
    }
    /**
     *  The unique identifier (GUID) for the service SKU. 
     * @return string
     */
    public function getSkuId()
    {
        if (!$this->isPropertyAvailable("SkuId")) {
            return null;
        }
        return $this->getProperty("SkuId");
    }
    /**
     *  The unique identifier (GUID) for the service SKU. 
     * @var string
     */
    public function setSkuId($value)
    {
        $this->setProperty("SkuId", $value, true);
    }
    /**
     *  The SKU part number; for example: "AAD_PREMIUM" or "RMSBASIC". To get a list of commercial subscriptions that an organization has acquired, see [List subscribedSkus](../api/subscribedsku-list.md).
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
     *  The SKU part number; for example: "AAD_PREMIUM" or "RMSBASIC". To get a list of commercial subscriptions that an organization has acquired, see [List subscribedSkus](../api/subscribedsku-list.md).
     * @var string
     */
    public function setSkuPartNumber($value)
    {
        $this->setProperty("SkuPartNumber", $value, true);
    }
    /**
     *  For example, "User" or "Company". 
     * @return string
     */
    public function getAppliesTo()
    {
        if (!$this->isPropertyAvailable("AppliesTo")) {
            return null;
        }
        return $this->getProperty("AppliesTo");
    }
    /**
     *  For example, "User" or "Company". 
     * @var string
     */
    public function setAppliesTo($value)
    {
        $this->setProperty("AppliesTo", $value, true);
    }
    /**
     *  Information about the number and status of prepaid licenses. 
     * @return LicenseUnitsDetail
     */
    public function getPrepaidUnits()
    {
        if (!$this->isPropertyAvailable("PrepaidUnits")) {
            return null;
        }
        return $this->getProperty("PrepaidUnits");
    }
    /**
     *  Information about the number and status of prepaid licenses. 
     * @var LicenseUnitsDetail
     */
    public function setPrepaidUnits($value)
    {
        $this->setProperty("PrepaidUnits", $value, true);
    }
}