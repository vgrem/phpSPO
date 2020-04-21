<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T18:22:48+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ResourcePath;

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
            $this->setProperty("External", new AppPrincipalIdentityProvider($this->getContext(),
                new ResourcePath("External", $this->getResourcePath())));
        }
        return $this->getProperty("External");
    }
}