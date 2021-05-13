<?php

/**
 * Modified: 2020-05-25T06:42:59+00:00
 */
namespace Office365\Common;

use Office365\Entity;


/**
 *  "Represents a domain associated with the tenant."
 */
class Domain extends Entity
{
    /**
     *  Indicates the configured authentication type for the domain. The value is either *Managed* or *Federated*.<br> *Managed* indicates a cloud managed domain where Azure AD performs user authentication.<br>*Federated* indicates authentication is federated with an identity provider such as the tenant's on-premises Active Directory via Active Directory Federation Services. This property is read-only and is not nullable. 
     * @return string
     */
    public function getAuthenticationType()
    {
        if (!$this->isPropertyAvailable("AuthenticationType")) {
            return null;
        }
        return $this->getProperty("AuthenticationType");
    }
    /**
     *  Indicates the configured authentication type for the domain. The value is either *Managed* or *Federated*.<br> *Managed* indicates a cloud managed domain where Azure AD performs user authentication.<br>*Federated* indicates authentication is federated with an identity provider such as the tenant's on-premises Active Directory via Active Directory Federation Services. This property is read-only and is not nullable. 
     * @var string
     */
    public function setAuthenticationType($value)
    {
        $this->setProperty("AuthenticationType", $value, true);
    }
    /**
     *  This property is always null except when the [verify](../api/domain-verify.md) action is used. When the [verify](../api/domain-verify.md) action is used, a **domain** entity is returned in the response. The **availabilityStatus** property of the **domain** entity in the response is either *AvailableImmediately* or *EmailVerifiedDomainTakeoverScheduled*.
     * @return string
     */
    public function getAvailabilityStatus()
    {
        if (!$this->isPropertyAvailable("AvailabilityStatus")) {
            return null;
        }
        return $this->getProperty("AvailabilityStatus");
    }
    /**
     *  This property is always null except when the [verify](../api/domain-verify.md) action is used. When the [verify](../api/domain-verify.md) action is used, a **domain** entity is returned in the response. The **availabilityStatus** property of the **domain** entity in the response is either *AvailableImmediately* or *EmailVerifiedDomainTakeoverScheduled*.
     * @var string
     */
    public function setAvailabilityStatus($value)
    {
        $this->setProperty("AvailabilityStatus", $value, true);
    }
    /**
     *  The value of the property is false if the DNS record management of the domain has been delegated to Office 365. Otherwise, the value is true. Not nullable 
     * @return bool
     */
    public function getIsAdminManaged()
    {
        if (!$this->isPropertyAvailable("IsAdminManaged")) {
            return null;
        }
        return $this->getProperty("IsAdminManaged");
    }
    /**
     *  The value of the property is false if the DNS record management of the domain has been delegated to Office 365. Otherwise, the value is true. Not nullable 
     * @var bool
     */
    public function setIsAdminManaged($value)
    {
        $this->setProperty("IsAdminManaged", $value, true);
    }
    /**
     *  True if this is the default domain that is used for user creation. There is only one default domain per company. Not nullable 
     * @return bool
     */
    public function getIsDefault()
    {
        if (!$this->isPropertyAvailable("IsDefault")) {
            return null;
        }
        return $this->getProperty("IsDefault");
    }
    /**
     *  True if this is the default domain that is used for user creation. There is only one default domain per company. Not nullable 
     * @var bool
     */
    public function setIsDefault($value)
    {
        $this->setProperty("IsDefault", $value, true);
    }
    /**
     *  True if this is the initial domain created by Microsoft Online Services (companyname.onmicrosoft.com). There is only one initial domain per company. Not nullable 
     * @return bool
     */
    public function getIsInitial()
    {
        if (!$this->isPropertyAvailable("IsInitial")) {
            return null;
        }
        return $this->getProperty("IsInitial");
    }
    /**
     *  True if this is the initial domain created by Microsoft Online Services (companyname.onmicrosoft.com). There is only one initial domain per company. Not nullable 
     * @var bool
     */
    public function setIsInitial($value)
    {
        $this->setProperty("IsInitial", $value, true);
    }
    /**
     *  True if the domain is a verified root domain. Otherwise, false if the domain is a subdomain or unverified. Not nullable 
     * @return bool
     */
    public function getIsRoot()
    {
        if (!$this->isPropertyAvailable("IsRoot")) {
            return null;
        }
        return $this->getProperty("IsRoot");
    }
    /**
     *  True if the domain is a verified root domain. Otherwise, false if the domain is a subdomain or unverified. Not nullable 
     * @var bool
     */
    public function setIsRoot($value)
    {
        $this->setProperty("IsRoot", $value, true);
    }
    /**
     *  True if the domain has completed domain ownership verification. Not nullable 
     * @return bool
     */
    public function getIsVerified()
    {
        if (!$this->isPropertyAvailable("IsVerified")) {
            return null;
        }
        return $this->getProperty("IsVerified");
    }
    /**
     *  True if the domain has completed domain ownership verification. Not nullable 
     * @var bool
     */
    public function setIsVerified($value)
    {
        $this->setProperty("IsVerified", $value, true);
    }
    /**
     * @return string
     */
    public function getManufacturer()
    {
        if (!$this->isPropertyAvailable("Manufacturer")) {
            return null;
        }
        return $this->getProperty("Manufacturer");
    }
    /**
     * @var string
     */
    public function setManufacturer($value)
    {
        $this->setProperty("Manufacturer", $value, true);
    }
    /**
     * @return string
     */
    public function getModel()
    {
        if (!$this->isPropertyAvailable("Model")) {
            return null;
        }
        return $this->getProperty("Model");
    }
    /**
     * @var string
     */
    public function setModel($value)
    {
        $this->setProperty("Model", $value, true);
    }
    /**
     * Specifies the number of days before a user receives notification that their password will expire. If the property is not set, a default value of 14 days will be used.
     * @return integer
     */
    public function getPasswordNotificationWindowInDays()
    {
        if (!$this->isPropertyAvailable("PasswordNotificationWindowInDays")) {
            return null;
        }
        return $this->getProperty("PasswordNotificationWindowInDays");
    }
    /**
     * Specifies the number of days before a user receives notification that their password will expire. If the property is not set, a default value of 14 days will be used.
     * @var integer
     */
    public function setPasswordNotificationWindowInDays($value)
    {
        $this->setProperty("PasswordNotificationWindowInDays", $value, true);
    }
    /**
     *  Specifies the length of time that a password is valid before it must be changed. If the property is not set, a default value of 90 days will be used. 
     * @return integer
     */
    public function getPasswordValidityPeriodInDays()
    {
        if (!$this->isPropertyAvailable("PasswordValidityPeriodInDays")) {
            return null;
        }
        return $this->getProperty("PasswordValidityPeriodInDays");
    }
    /**
     *  Specifies the length of time that a password is valid before it must be changed. If the property is not set, a default value of 90 days will be used. 
     * @var integer
     */
    public function setPasswordValidityPeriodInDays($value)
    {
        $this->setProperty("PasswordValidityPeriodInDays", $value, true);
    }
    /**
     *  The capabilities assigned to the domain.<br><br>Can include 0, 1 or more of following values: *Email*, *Sharepoint*, *EmailInternalRelayOnly*, *OfficeCommunicationsOnline*, *SharePointDefaultDomain*, *FullRedelegation*, *SharePointPublic*, *OrgIdAuthentication*, *Yammer*, *Intune*<br><br> The values which you can add/remove using Graph API include: *Email*, *OfficeCommunicationsOnline*, *Yammer*<br>Not nullable
     * @return array
     */
    public function getSupportedServices()
    {
        if (!$this->isPropertyAvailable("SupportedServices")) {
            return null;
        }
        return $this->getProperty("SupportedServices");
    }
    /**
     *  The capabilities assigned to the domain.<br><br>Can include 0, 1 or more of following values: *Email*, *Sharepoint*, *EmailInternalRelayOnly*, *OfficeCommunicationsOnline*, *SharePointDefaultDomain*, *FullRedelegation*, *SharePointPublic*, *OrgIdAuthentication*, *Yammer*, *Intune*<br><br> The values which you can add/remove using Graph API include: *Email*, *OfficeCommunicationsOnline*, *Yammer*<br>Not nullable
     * @var array
     */
    public function setSupportedServices($value)
    {
        $this->setProperty("SupportedServices", $value, true);
    }
    /**
     *  Status of asynchronous operations scheduled for the domain. 
     * @return DomainState
     */
    public function getState()
    {
        if (!$this->isPropertyAvailable("State")) {
            return null;
        }
        return $this->getProperty("State");
    }
    /**
     *  Status of asynchronous operations scheduled for the domain. 
     * @var DomainState
     */
    public function setState($value)
    {
        $this->setProperty("State", $value, true);
    }
}