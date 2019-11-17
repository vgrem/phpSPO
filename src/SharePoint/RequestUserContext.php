<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T18:22:48+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
/**
 * The class 
 * that represents the user context for the present request. Typically found under 
 * /_api/me
 */
class RequestUserContext extends ClientObject
{
    /**
     * @return User
     */
    public function getUser()
    {
        if (!$this->isPropertyAvailable("User")) {
            $this->setProperty("User", new User($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "User")));
        }
        return $this->getProperty("User");
    }
    /**
     * @return RequestUserContext
     */
    public function getCurrent()
    {
        if (!$this->isPropertyAvailable("Current")) {
            $this->setProperty("Current", new RequestUserContext($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "Current")));
        }
        return $this->getProperty("Current");
    }
}