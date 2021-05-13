<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

/**
 *  "Represents the delegated permissions (OAuth 2.0 scopes) which have been granted to an application, often as a result of user or admin consent process."
 */
class OAuth2PermissionGrant extends ClientObject
{
    /**
     * @return string
     */
    public function getClientId()
    {
        if (!$this->isPropertyAvailable("ClientId")) {
            return null;
        }
        return $this->getProperty("ClientId");
    }
    /**
     * @var string
     */
    public function setClientId($value)
    {
        $this->setProperty("ClientId", $value, true);
    }
    /**
     * @return string
     */
    public function getConsentType()
    {
        if (!$this->isPropertyAvailable("ConsentType")) {
            return null;
        }
        return $this->getProperty("ConsentType");
    }
    /**
     * @var string
     */
    public function setConsentType($value)
    {
        $this->setProperty("ConsentType", $value, true);
    }
    /**
     * @return string
     */
    public function getPrincipalId()
    {
        if (!$this->isPropertyAvailable("PrincipalId")) {
            return null;
        }
        return $this->getProperty("PrincipalId");
    }
    /**
     * @var string
     */
    public function setPrincipalId($value)
    {
        $this->setProperty("PrincipalId", $value, true);
    }
    /**
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
     * @var string
     */
    public function setResourceId($value)
    {
        $this->setProperty("ResourceId", $value, true);
    }
    /**
     * @return string
     */
    public function getScope()
    {
        if (!$this->isPropertyAvailable("Scope")) {
            return null;
        }
        return $this->getProperty("Scope");
    }
    /**
     * @var string
     */
    public function setScope($value)
    {
        $this->setProperty("Scope", $value, true);
    }
}