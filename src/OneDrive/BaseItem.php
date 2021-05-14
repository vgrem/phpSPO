<?php

/**
 * Modified: 2020-05-25T05:58:15+00:00 
 */
namespace Office365\OneDrive;


use Office365\Common\IdentitySet;
use Office365\Common\User;
use Office365\Entity;
use Office365\Runtime\ResourcePath;
class BaseItem extends Entity
{
    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->getProperty("Description");
    }

    /**
     *
     * @return self
     * @var string
     */
    public function setDescription($value)
    {
        return $this->setProperty("Description", $value, true);
    }
    /**
     * @return string
     */
    public function getETag()
    {
        return $this->getProperty("ETag");
    }

    /**
     *
     * @return self
     * @var string
     */
    public function setETag($value)
    {
        return $this->setProperty("ETag", $value, true);
    }
    /**
     * @return string
     */
    public function getName()
    {
        return $this->getProperty("Name");
    }

    /**
     * @return self
     * @var string
     */
    public function setName($value)
    {
        return $this->setProperty("Name", $value, true);
    }
    /**
     * @return string
     */
    public function getWebUrl()
    {
        return $this->getProperty("WebUrl");
    }

    /**
     *
     * @return self
     * @var string
     */
    public function setWebUrl($value)
    {
        return $this->setProperty("WebUrl", $value, true);
    }
    /**
     * @return User
     */
    public function getCreatedByUser()
    {
        return $this->getProperty("CreatedByUser",
            new User($this->getContext(), new ResourcePath("CreatedByUser", $this->getResourcePath())));
    }
    /**
     * @return User
     */
    public function getLastModifiedByUser()
    {
        return $this->getProperty("LastModifiedByUser",
            new User($this->getContext(), new ResourcePath("LastModifiedByUser", $this->getResourcePath())));
    }
    /**
     * @return IdentitySet
     */
    public function getCreatedBy()
    {
        return $this->getProperty("CreatedBy", new IdentitySet());
    }

    /**
     *
     * @return self
     * @var IdentitySet
     */
    public function setCreatedBy($value)
    {
        return $this->setProperty("CreatedBy", $value, true);
    }
    /**
     * @return IdentitySet
     */
    public function getLastModifiedBy()
    {
        return $this->getProperty("LastModifiedBy", new IdentitySet());
    }

    /**
     *
     * @return self
     * @var IdentitySet
     */
    public function setLastModifiedBy($value)
    {
        return $this->setProperty("LastModifiedBy", $value, true);
    }
    /**
     * @return ItemReference
     */
    public function getParentReference()
    {
        return $this->getProperty("ParentReference", new ItemReference());
    }

    /**
     *
     * @return self
     * @var ItemReference
     */
    public function setParentReference($value)
    {
        return $this->setProperty("ParentReference", $value, true);
    }

}