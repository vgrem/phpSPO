<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00
 */
namespace Office365\Common;

use Office365\Entity;

/**
 *  "Represents potential security issues within a customer's tenant that Microsoft or partner security solutions have identified. Use alerts to unify and streamline security issue management across all integrated solutions. To learn more, see the sample queries in Graph Explorer."
 */
class Alert extends Entity
{
    /**
     * Name or alias of the activity group (attacker) this alert is attributed to.
     * @return string
     */
    public function getActivityGroupName()
    {
        return $this->getProperty("ActivityGroupName");
    }
    /**
     * Name or alias of the activity group (attacker) this alert is attributed to.
     * @var string
     */
    public function setActivityGroupName($value)
    {
        $this->setProperty("ActivityGroupName", $value, true);
    }
    /**
     * Name of the analyst the alert is assigned to for triage, investigation, or remediation (supports [update](../api/alert-update.md)).
     * @return string
     */
    public function getAssignedTo()
    {
        return $this->getProperty("AssignedTo");
    }
    /**
     * Name of the analyst the alert is assigned to for triage, investigation, or remediation (supports [update](../api/alert-update.md)).
     * @var string
     */
    public function setAssignedTo($value)
    {
        $this->setProperty("AssignedTo", $value, true);
    }
    /**
     * Azure subscription ID, present if this alert is related to an Azure resource.
     * @return string
     */
    public function getAzureSubscriptionId()
    {
        return $this->getProperty("AzureSubscriptionId");
    }
    /**
     * Azure subscription ID, present if this alert is related to an Azure resource.
     * @var string
     */
    public function setAzureSubscriptionId($value)
    {
        $this->setProperty("AzureSubscriptionId", $value, true);
    }
    /**
     * @return string
     */
    public function getAzureTenantId()
    {
        return $this->getProperty("AzureTenantId");
    }
    /**
     * @var string
     */
    public function setAzureTenantId($value)
    {
        $this->setProperty("AzureTenantId", $value, true);
    }
    /**
     * Category of the alert (for example, credentialTheft, ransomware, etc.).
     * @return string
     */
    public function getCategory()
    {
        if (!$this->isPropertyAvailable("Category")) {
            return null;
        }
        return $this->getProperty("Category");
    }
    /**
     * Category of the alert (for example, credentialTheft, ransomware, etc.).
     * @var string
     */
    public function setCategory($value)
    {
        $this->setProperty("Category", $value, true);
    }
    /**
     * Customer-provided comments on alert (for customer alert management) (supports [update](../api/alert-update.md)).
     * @return array
     */
    public function getComments()
    {
        if (!$this->isPropertyAvailable("Comments")) {
            return null;
        }
        return $this->getProperty("Comments");
    }
    /**
     * Customer-provided comments on alert (for customer alert management) (supports [update](../api/alert-update.md)).
     * @var array
     */
    public function setComments($value)
    {
        $this->setProperty("Comments", $value, true);
    }
    /**
     * Confidence of the detection logic (percentage between 1-100).
     * @return integer
     */
    public function getConfidence()
    {
        return $this->getProperty("Confidence");
    }

    /**
     * Confidence of the detection logic (percentage between 1-100).
     *
     * @return self
     * @var integer
     */
    public function setConfidence($value)
    {
        return $this->setProperty("Confidence", $value, true);
    }
    /**
     * Alert description.
     * @return string
     */
    public function getDescription()
    {
        if (!$this->isPropertyAvailable("Description")) {
            return null;
        }
        return $this->getProperty("Description");
    }
    /**
     * Alert description.
     * @var string
     */
    public function setDescription($value)
    {
        $this->setProperty("Description", $value, true);
    }
    /**
     * Set of alerts related to this alert entity (each alert is pushed to the SIEM as a separate record).
     * @return array
     */
    public function getDetectionIds()
    {
        if (!$this->isPropertyAvailable("DetectionIds")) {
            return null;
        }
        return $this->getProperty("DetectionIds");
    }
    /**
     * Set of alerts related to this alert entity (each alert is pushed to the SIEM as a separate record).
     * @var array
     */
    public function setDetectionIds($value)
    {
        $this->setProperty("DetectionIds", $value, true);
    }
    /**
     * Vendor/provider recommended action(s) to take as a result of the alert (for example, isolate machine, enforce2FA, reimage host).
     * @return array
     */
    public function getRecommendedActions()
    {
        if (!$this->isPropertyAvailable("RecommendedActions")) {
            return null;
        }
        return $this->getProperty("RecommendedActions");
    }
    /**
     * Vendor/provider recommended action(s) to take as a result of the alert (for example, isolate machine, enforce2FA, reimage host).
     * @var array
     */
    public function setRecommendedActions($value)
    {
        $this->setProperty("RecommendedActions", $value, true);
    }
    /**
     * Hyperlinks (URIs) to the source material related to the alert, for example, provider's user interface for alerts or log search, etc.
     * @return array
     */
    public function getSourceMaterials()
    {
        return $this->getProperty("SourceMaterials");
    }
    /**
     * Hyperlinks (URIs) to the source material related to the alert, for example, provider's user interface for alerts or log search, etc.
     * @var array
     */
    public function setSourceMaterials($value)
    {
        $this->setProperty("SourceMaterials", $value, true);
    }
    /**
     * User-definable labels that can be applied to an alert and can serve as filter conditions (for example "HVA", "SAW", etc.) (supports [update](../api/alert-update.md)).
     * @return array
     */
    public function getTags()
    {
        return $this->getProperty("Tags");
    }
    /**
     * User-definable labels that can be applied to an alert and can serve as filter conditions (for example "HVA", "SAW", etc.) (supports [update](../api/alert-update.md)).
     * @var array
     */
    public function setTags($value)
    {
        $this->setProperty("Tags", $value, true);
    }
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getProperty("Title");
    }
    /**
     * @var string
     */
    public function setTitle($value)
    {
        $this->setProperty("Title", $value, true);
    }
    /**
     * @return SecurityVendorInformation
     */
    public function getVendorInformation()
    {
        return $this->getProperty("VendorInformation", new SecurityVendorInformation());
    }

    /**
     * @return self
     * @var SecurityVendorInformation
     */
    public function setVendorInformation($value)
    {
        return $this->setProperty("VendorInformation", $value, true);
    }
}