<?php

/**
 * Modified: 2020-05-24T21:23:29+00:00
 */
namespace Office365\Common;


use Office365\Entity;

/**
 * Represents the directory audit items and its collection.
 */
class DirectoryAudit extends Entity
{
    /**
     * Indicates which resource category that's targeted by the activity. (For example: User Management, Group Management etc..)
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
     * Indicates which resource category that's targeted by the activity. (For example: User Management, Group Management etc..)
     * @var string
     */
    public function setCategory($value)
    {
        $this->setProperty("Category", $value, true);
    }
    /**
     * Indicates a unique ID that helps correlate activities that span across various services. Can be used to trace logs across services.
     * @return string
     */
    public function getCorrelationId()
    {
        if (!$this->isPropertyAvailable("CorrelationId")) {
            return null;
        }
        return $this->getProperty("CorrelationId");
    }
    /**
     * Indicates a unique ID that helps correlate activities that span across various services. Can be used to trace logs across services.
     * @var string
     */
    public function setCorrelationId($value)
    {
        $this->setProperty("CorrelationId", $value, true);
    }
    /**
     * Describes cause of "failure" or "timeout" results.
     * @return string
     */
    public function getResultReason()
    {
        if (!$this->isPropertyAvailable("ResultReason")) {
            return null;
        }
        return $this->getProperty("ResultReason");
    }
    /**
     * Describes cause of "failure" or "timeout" results.
     * @var string
     */
    public function setResultReason($value)
    {
        $this->setProperty("ResultReason", $value, true);
    }
    /**
     * Indicates the activity name or the operation name (examples: "Create User" and "Add member to group"). For full list, see [Azure AD activity list](https://docs.microsoft.com/azure/active-directory/active-directory-reporting-activity-audit-logs#azure-ad-audit-activity-list).
     * @return string
     */
    public function getActivityDisplayName()
    {
        if (!$this->isPropertyAvailable("ActivityDisplayName")) {
            return null;
        }
        return $this->getProperty("ActivityDisplayName");
    }
    /**
     * Indicates the activity name or the operation name (examples: "Create User" and "Add member to group"). For full list, see [Azure AD activity list](https://docs.microsoft.com/azure/active-directory/active-directory-reporting-activity-audit-logs#azure-ad-audit-activity-list).
     * @var string
     */
    public function setActivityDisplayName($value)
    {
        $this->setProperty("ActivityDisplayName", $value, true);
    }
    /**
     * Indicates information on which service initiated the activity (For example: Self-service Password Management, Core Directory, B2C, Invited Users, Microsoft Identity Manager, Privileged Identity Management.
     * @return string
     */
    public function getLoggedByService()
    {
        if (!$this->isPropertyAvailable("LoggedByService")) {
            return null;
        }
        return $this->getProperty("LoggedByService");
    }
    /**
     * Indicates information on which service initiated the activity (For example: Self-service Password Management, Core Directory, B2C, Invited Users, Microsoft Identity Manager, Privileged Identity Management.
     * @var string
     */
    public function setLoggedByService($value)
    {
        $this->setProperty("LoggedByService", $value, true);
    }
    /**
     * @return string
     */
    public function getOperationType()
    {
        if (!$this->isPropertyAvailable("OperationType")) {
            return null;
        }
        return $this->getProperty("OperationType");
    }
    /**
     * @var string
     */
    public function setOperationType($value)
    {
        $this->setProperty("OperationType", $value, true);
    }
    /**
     * Indicates information about the user or app initiated the activity.
     * @return AuditActivityInitiator
     */
    public function getInitiatedBy()
    {
        if (!$this->isPropertyAvailable("InitiatedBy")) {
            return null;
        }
        return $this->getProperty("InitiatedBy");
    }
    /**
     * Indicates information about the user or app initiated the activity.
     * @var AuditActivityInitiator
     */
    public function setInitiatedBy($value)
    {
        $this->setProperty("InitiatedBy", $value, true);
    }
}