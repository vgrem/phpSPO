<?php

/**
 * Modified: 2020-05-24T22:08:35+00:00
 */
namespace Office365\Common;

use Office365\Entity;

/**
 *  "Represents an Azure Active Directory (Azure AD) identity provider."
 */
class IdentityProvider extends Entity
{
    /**
     * @return string
     */
    public function getType()
    {
        if (!$this->isPropertyAvailable("Type")) {
            return null;
        }
        return $this->getProperty("Type");
    }
    /**
     * @var string
     */
    public function setType($value)
    {
        $this->setProperty("Type", $value, true);
    }
    /**
     * @return string
     */
    public function getName()
    {
        if (!$this->isPropertyAvailable("Name")) {
            return null;
        }
        return $this->getProperty("Name");
    }
    /**
     * @var string
     */
    public function setName($value)
    {
        $this->setProperty("Name", $value, true);
    }
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
    public function getClientSecret()
    {
        if (!$this->isPropertyAvailable("ClientSecret")) {
            return null;
        }
        return $this->getProperty("ClientSecret");
    }
    /**
     * @var string
     */
    public function setClientSecret($value)
    {
        $this->setProperty("ClientSecret", $value, true);
    }
}