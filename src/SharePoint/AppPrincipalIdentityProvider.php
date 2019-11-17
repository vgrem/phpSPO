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
 * Represents 
 * an identity provider for app principals.
 */
class AppPrincipalIdentityProvider extends ClientObject
{
    /**
     * @return AppPrincipalIdentityProvider
     */
    public function getExternal()
    {
        if (!$this->isPropertyAvailable("External")) {
            $this->setProperty("External", new AppPrincipalIdentityProvider($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "External")));
        }
        return $this->getProperty("External");
    }
}