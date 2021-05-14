<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\OneDrive;

use Office365\Common\IdentitySet;
use Office365\Entity;


/**
 *  "The Permission resource provides information about a sharing permission granted for a DriveItem resource."
 */
class Permission extends Entity
{
    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->getProperty("Roles");
    }

    /**
     *
     * @return self
     * @var array
     */
    public function setRoles($value)
    {
        return $this->setProperty("Roles", $value, true);
    }
    /**
     * @return string
     */
    public function getShareId()
    {
        return $this->getProperty("ShareId");
    }
    /**
     * @var string
     */
    public function setShareId($value)
    {
        $this->setProperty("ShareId", $value, true);
    }
    /**
     * @return IdentitySet
     */
    public function getGrantedTo()
    {
        return $this->getProperty("GrantedTo", new IdentitySet());
    }

    /**
     *
     * @return self
     * @var IdentitySet
     */
    public function setGrantedTo($value)
    {
        return $this->setProperty("GrantedTo", $value, true);
    }
    /**
     * @return ItemReference
     */
    public function getInheritedFrom()
    {
        return $this->getProperty("InheritedFrom", new ItemReference());
    }
    /**
     * @var ItemReference
     */
    public function setInheritedFrom($value)
    {
        $this->setProperty("InheritedFrom", $value, true);
    }
    /**
     * @return SharingInvitation
     */
    public function getInvitation()
    {
        return $this->getProperty("Invitation", new SharingInvitation());
    }
    /**
     * @var SharingInvitation
     */
    public function setInvitation($value)
    {
        $this->setProperty("Invitation", $value, true);
    }
    /**
     * @return SharingLink
     */
    public function getLink()
    {
        return $this->getProperty("Link", new SharingLink());
    }
    /**
     * @var SharingLink
     */
    public function setLink($value)
    {
        $this->setProperty("Link", $value, true);
    }
    /**
     * @return bool
     */
    public function getHasPassword()
    {
        return $this->getProperty("HasPassword");
    }
    /**
     * @var bool
     */
    public function setHasPassword($value)
    {
        $this->setProperty("HasPassword", $value, true);
    }
}