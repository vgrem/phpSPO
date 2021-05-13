<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

/**
 * Represents a tenant's secure score per control data. By default, it returns all controls for a tenant and can explicitly pull individual controls.
 */
class SecureScoreControlProfile extends ClientObject
{
    /**
     * Control action type (Config, Review, Behavior).
     * @return string
     */
    public function getActionType()
    {
        if (!$this->isPropertyAvailable("ActionType")) {
            return null;
        }
        return $this->getProperty("ActionType");
    }
    /**
     * Control action type (Config, Review, Behavior).
     * @var string
     */
    public function setActionType($value)
    {
        $this->setProperty("ActionType", $value, true);
    }
    /**
     * URL to where the control can be actioned. 
     * @return string
     */
    public function getActionUrl()
    {
        if (!$this->isPropertyAvailable("ActionUrl")) {
            return null;
        }
        return $this->getProperty("ActionUrl");
    }
    /**
     * URL to where the control can be actioned. 
     * @var string
     */
    public function setActionUrl($value)
    {
        $this->setProperty("ActionUrl", $value, true);
    }
    /**
     * GUID string for tenant ID.
     * @return string
     */
    public function getAzureTenantId()
    {
        if (!$this->isPropertyAvailable("AzureTenantId")) {
            return null;
        }
        return $this->getProperty("AzureTenantId");
    }
    /**
     * GUID string for tenant ID.
     * @var string
     */
    public function setAzureTenantId($value)
    {
        $this->setProperty("AzureTenantId", $value, true);
    }
    /**
     * Control action category (Identity, Data, Device, Apps, Infrastructure).
     * @return string
     */
    public function getControlCategory()
    {
        if (!$this->isPropertyAvailable("ControlCategory")) {
            return null;
        }
        return $this->getProperty("ControlCategory");
    }
    /**
     * Control action category (Identity, Data, Device, Apps, Infrastructure).
     * @var string
     */
    public function setControlCategory($value)
    {
        $this->setProperty("ControlCategory", $value, true);
    }
    /**
     * Flag to indicate if a control is depreciated.
     * @return bool
     */
    public function getDeprecated()
    {
        if (!$this->isPropertyAvailable("Deprecated")) {
            return null;
        }
        return $this->getProperty("Deprecated");
    }
    /**
     * Flag to indicate if a control is depreciated.
     * @var bool
     */
    public function setDeprecated($value)
    {
        $this->setProperty("Deprecated", $value, true);
    }
    /**
     * Resource cost of implemmentating control (low, moderate, high).
     * @return string
     */
    public function getImplementationCost()
    {
        if (!$this->isPropertyAvailable("ImplementationCost")) {
            return null;
        }
        return $this->getProperty("ImplementationCost");
    }
    /**
     * Resource cost of implemmentating control (low, moderate, high).
     * @var string
     */
    public function setImplementationCost($value)
    {
        $this->setProperty("ImplementationCost", $value, true);
    }
    /**
     * max attainable score for the control.
     * @return double
     */
    public function getMaxScore()
    {
        if (!$this->isPropertyAvailable("MaxScore")) {
            return null;
        }
        return $this->getProperty("MaxScore");
    }
    /**
     * max attainable score for the control.
     * @var double
     */
    public function setMaxScore($value)
    {
        $this->setProperty("MaxScore", $value, true);
    }
    /**
     * Microsoft's stack ranking of control.
     * @return integer
     */
    public function getRank()
    {
        if (!$this->isPropertyAvailable("Rank")) {
            return null;
        }
        return $this->getProperty("Rank");
    }
    /**
     * Microsoft's stack ranking of control.
     * @var integer
     */
    public function setRank($value)
    {
        $this->setProperty("Rank", $value, true);
    }
    /**
     * Description of what the control will help remediate.
     * @return string
     */
    public function getRemediation()
    {
        if (!$this->isPropertyAvailable("Remediation")) {
            return null;
        }
        return $this->getProperty("Remediation");
    }
    /**
     * Description of what the control will help remediate.
     * @var string
     */
    public function setRemediation($value)
    {
        $this->setProperty("Remediation", $value, true);
    }
    /**
     * Description of the impact on users of the remediation.
     * @return string
     */
    public function getRemediationImpact()
    {
        if (!$this->isPropertyAvailable("RemediationImpact")) {
            return null;
        }
        return $this->getProperty("RemediationImpact");
    }
    /**
     * Description of the impact on users of the remediation.
     * @var string
     */
    public function setRemediationImpact($value)
    {
        $this->setProperty("RemediationImpact", $value, true);
    }
    /**
     * Service that owns the control (Exchange, Sharepoint, Azure AD).
     * @return string
     */
    public function getService()
    {
        if (!$this->isPropertyAvailable("Service")) {
            return null;
        }
        return $this->getProperty("Service");
    }
    /**
     * Service that owns the control (Exchange, Sharepoint, Azure AD).
     * @var string
     */
    public function setService($value)
    {
        $this->setProperty("Service", $value, true);
    }
    /**
     * List of threats the control mitigates (accountBreach,dataDeletion,dataExfiltration,dataSpillage,
     * @return array
     */
    public function getThreats()
    {
        if (!$this->isPropertyAvailable("Threats")) {
            return null;
        }
        return $this->getProperty("Threats");
    }
    /**
     * List of threats the control mitigates (accountBreach,dataDeletion,dataExfiltration,dataSpillage,
     * @var array
     */
    public function setThreats($value)
    {
        $this->setProperty("Threats", $value, true);
    }
    /**
     * Control tier (Core, Defense in Depth, Advanced.)	
     * @return string
     */
    public function getTier()
    {
        if (!$this->isPropertyAvailable("Tier")) {
            return null;
        }
        return $this->getProperty("Tier");
    }
    /**
     * Control tier (Core, Defense in Depth, Advanced.)	
     * @var string
     */
    public function setTier($value)
    {
        $this->setProperty("Tier", $value, true);
    }
    /**
     * Title of the control.
     * @return string
     */
    public function getTitle()
    {
        if (!$this->isPropertyAvailable("Title")) {
            return null;
        }
        return $this->getProperty("Title");
    }
    /**
     * Title of the control.
     * @var string
     */
    public function setTitle($value)
    {
        $this->setProperty("Title", $value, true);
    }
    /**
     * User impact of implementing control (low, moderate, high).	
     * @return string
     */
    public function getUserImpact()
    {
        if (!$this->isPropertyAvailable("UserImpact")) {
            return null;
        }
        return $this->getProperty("UserImpact");
    }
    /**
     * User impact of implementing control (low, moderate, high).	
     * @var string
     */
    public function setUserImpact($value)
    {
        $this->setProperty("UserImpact", $value, true);
    }
    /**
     * Complex type containing details about the security product/service vendor, provider, and subprovider (for example, vendor=Microsoft; provider=SecureScore). Required.
     * @return SecurityVendorInformation
     */
    public function getVendorInformation()
    {
        if (!$this->isPropertyAvailable("VendorInformation")) {
            return null;
        }
        return $this->getProperty("VendorInformation");
    }
    /**
     * Complex type containing details about the security product/service vendor, provider, and subprovider (for example, vendor=Microsoft; provider=SecureScore). Required.
     * @var SecurityVendorInformation
     */
    public function setVendorInformation($value)
    {
        $this->setProperty("VendorInformation", $value, true);
    }
}