<?php

/**
 * Modified: 2020-05-29T07:14:53+00:00
 */
namespace Office365\Common;

use Office365\Entity;
use Office365\Intune\DeviceDetail;

/**
 * Details user and application sign-in activity for a tenant (directory).
 */
class SignIn extends Entity
{
    /**
     * Display name of the user that initiated the sign-in.
     * @return string
     */
    public function getUserDisplayName()
    {
        if (!$this->isPropertyAvailable("UserDisplayName")) {
            return null;
        }
        return $this->getProperty("UserDisplayName");
    }
    /**
     * Display name of the user that initiated the sign-in.
     * @var string
     */
    public function setUserDisplayName($value)
    {
        $this->setProperty("UserDisplayName", $value, true);
    }
    /**
     * User principal name of the user that initiated the sign-in.
     * @return string
     */
    public function getUserPrincipalName()
    {
        if (!$this->isPropertyAvailable("UserPrincipalName")) {
            return null;
        }
        return $this->getProperty("UserPrincipalName");
    }
    /**
     * User principal name of the user that initiated the sign-in.
     * @var string
     */
    public function setUserPrincipalName($value)
    {
        $this->setProperty("UserPrincipalName", $value, true);
    }
    /**
     * ID of the user that initiated the sign-in.
     * @return string
     */
    public function getUserId()
    {
        if (!$this->isPropertyAvailable("UserId")) {
            return null;
        }
        return $this->getProperty("UserId");
    }
    /**
     * ID of the user that initiated the sign-in.
     * @var string
     */
    public function setUserId($value)
    {
        $this->setProperty("UserId", $value, true);
    }
    /**
     * Unique GUID representing the app ID in the Azure Active Directory.
     * @return string
     */
    public function getAppId()
    {
        if (!$this->isPropertyAvailable("AppId")) {
            return null;
        }
        return $this->getProperty("AppId");
    }
    /**
     * Unique GUID representing the app ID in the Azure Active Directory.
     * @var string
     */
    public function setAppId($value)
    {
        $this->setProperty("AppId", $value, true);
    }
    /**
     * App name displayed in the Azure Portal.
     * @return string
     */
    public function getAppDisplayName()
    {
        if (!$this->isPropertyAvailable("AppDisplayName")) {
            return null;
        }
        return $this->getProperty("AppDisplayName");
    }
    /**
     * App name displayed in the Azure Portal.
     * @var string
     */
    public function setAppDisplayName($value)
    {
        $this->setProperty("AppDisplayName", $value, true);
    }
    /**
     * IP address of the client used to sign in.
     * @return string
     */
    public function getIpAddress()
    {
        if (!$this->isPropertyAvailable("IpAddress")) {
            return null;
        }
        return $this->getProperty("IpAddress");
    }
    /**
     * IP address of the client used to sign in.
     * @var string
     */
    public function setIpAddress($value)
    {
        $this->setProperty("IpAddress", $value, true);
    }
    /**
     * Identifies the legacy client used for sign-in activity.  Includes Browser, Exchange Active Sync, modern clients, IMAP, MAPI, SMTP, and POP.
     * @return string
     */
    public function getClientAppUsed()
    {
        if (!$this->isPropertyAvailable("ClientAppUsed")) {
            return null;
        }
        return $this->getProperty("ClientAppUsed");
    }
    /**
     * Identifies the legacy client used for sign-in activity.  Includes Browser, Exchange Active Sync, modern clients, IMAP, MAPI, SMTP, and POP.
     * @var string
     */
    public function setClientAppUsed($value)
    {
        $this->setProperty("ClientAppUsed", $value, true);
    }
    /**
     * The request ID sent from the client when the sign-in is initiated; used to troubleshoot sign-in activity.
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
     * The request ID sent from the client when the sign-in is initiated; used to troubleshoot sign-in activity.
     * @var string
     */
    public function setCorrelationId($value)
    {
        $this->setProperty("CorrelationId", $value, true);
    }
    /**
     * Indicates if a sign-in is interactive or not.
     * @return bool
     */
    public function getIsInteractive()
    {
        if (!$this->isPropertyAvailable("IsInteractive")) {
            return null;
        }
        return $this->getProperty("IsInteractive");
    }
    /**
     * Indicates if a sign-in is interactive or not.
     * @var bool
     */
    public function setIsInteractive($value)
    {
        $this->setProperty("IsInteractive", $value, true);
    }
    /**
     * Name of the resource the user signed into.
     * @return string
     */
    public function getResourceDisplayName()
    {
        if (!$this->isPropertyAvailable("ResourceDisplayName")) {
            return null;
        }
        return $this->getProperty("ResourceDisplayName");
    }
    /**
     * Name of the resource the user signed into.
     * @var string
     */
    public function setResourceDisplayName($value)
    {
        $this->setProperty("ResourceDisplayName", $value, true);
    }
    /**
     * ID of the resource that the user signed into.
     * @return string
     */
    public function getResourceId()
    {
        if (!$this->isPropertyAvailable("ResourceId")) {
            return null;
        }
        return $this->getProperty("ResourceId");
    }
    /**
     * ID of the resource that the user signed into.
     * @var string
     */
    public function setResourceId($value)
    {
        $this->setProperty("ResourceId", $value, true);
    }
    /**
     * Sign-in status. Possible values include `Success` and `Failure`.
     * @return SignInStatus
     */
    public function getStatus()
    {
        if (!$this->isPropertyAvailable("Status")) {
            return null;
        }
        return $this->getProperty("Status");
    }
    /**
     * Sign-in status. Possible values include `Success` and `Failure`.
     * @var SignInStatus
     */
    public function setStatus($value)
    {
        $this->setProperty("Status", $value, true);
    }
    /**
     * Device information from where the sign-in occurred; includes device ID, operating system, and browser. 
     * @return DeviceDetail
     */
    public function getDeviceDetail()
    {
        if (!$this->isPropertyAvailable("DeviceDetail")) {
            return null;
        }
        return $this->getProperty("DeviceDetail");
    }
    /**
     * Device information from where the sign-in occurred; includes device ID, operating system, and browser. 
     * @var DeviceDetail
     */
    public function setDeviceDetail($value)
    {
        $this->setProperty("DeviceDetail", $value, true);
    }
    /**
     * Provides the city, state, and country code where the sign-in originated.
     * @return SignInLocation
     */
    public function getLocation()
    {
        return $this->getProperty("Location", new SignInLocation());
    }
    /**
     * Provides the city, state, and country code where the sign-in originated.
     * @var SignInLocation
     */
    public function setLocation($value)
    {
        $this->setProperty("Location", $value, true);
    }
    /**
     * The list of risk event types associated with the sign-in. Possible values: `unlikelyTravel`, `anonymizedIPAddress`, `maliciousIPAddress`, `unfamiliarFeatures`, `malwareInfectedIPAddress`, `suspiciousIPAddress`, `leakedCredentials`, `investigationsThreatIntelligence`,  `generic`, or `unknownFutureValue`.
     * @return array
     */
    public function getRiskEventTypes_v2()
    {
        return $this->getProperty("RiskEventTypes_v2");
    }
    /**
     * The list of risk event types associated with the sign-in. Possible values: `unlikelyTravel`, `anonymizedIPAddress`, `maliciousIPAddress`, `unfamiliarFeatures`, `malwareInfectedIPAddress`, `suspiciousIPAddress`, `leakedCredentials`, `investigationsThreatIntelligence`,  `generic`, or `unknownFutureValue`.
     * @var array
     */
    public function setRiskEventTypes_v2($value)
    {
        $this->setProperty("RiskEventTypes_v2", $value, true);
    }
}