<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T17:00:44+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
/**
 * Specifies 
 * the request context information for a site collection when 
 * a SharePoint 
 * Add-in accesses that site collection.
 */
class AppContextSite extends ClientObject
{
    /**
     * @return Site
     */
    public function getSite()
    {
        if (!$this->isPropertyAvailable("Site")) {
            $this->setProperty("Site", new Site($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "Site")));
        }
        return $this->getProperty("Site");
    }
    /**
     * @return Web
     */
    public function getWeb()
    {
        if (!$this->isPropertyAvailable("Web")) {
            $this->setProperty("Web", new Web($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "Web")));
        }
        return $this->getProperty("Web");
    }
}
