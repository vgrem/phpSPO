<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\Common;


use Office365\Entity;

/**
 *  "Used to record when a user, group, or service principal is assigned to an app role on an application's service principal. You can create, read and delete app role assignments."
 */
class AppRoleAssignment extends Entity
{
    /**
     * @return string
     */
    public function getAppRoleId()
    {
        if (!$this->isPropertyAvailable("AppRoleId")) {
            return null;
        }
        return $this->getProperty("AppRoleId");
    }
    /**
     * @var string
     */
    public function setAppRoleId($value)
    {
        $this->setProperty("AppRoleId", $value, true);
    }
    /**
     * @return string
     */
    public function getPrincipalDisplayName()
    {
        if (!$this->isPropertyAvailable("PrincipalDisplayName")) {
            return null;
        }
        return $this->getProperty("PrincipalDisplayName");
    }
    /**
     * @var string
     */
    public function setPrincipalDisplayName($value)
    {
        $this->setProperty("PrincipalDisplayName", $value, true);
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
    public function getPrincipalType()
    {
        if (!$this->isPropertyAvailable("PrincipalType")) {
            return null;
        }
        return $this->getProperty("PrincipalType");
    }
    /**
     * @var string
     */
    public function setPrincipalType($value)
    {
        $this->setProperty("PrincipalType", $value, true);
    }
    /**
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
     * @var string
     */
    public function setResourceDisplayName($value)
    {
        $this->setProperty("ResourceDisplayName", $value, true);
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
}