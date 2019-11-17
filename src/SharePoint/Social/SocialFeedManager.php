<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T17:00:44+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint\Social;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;

class SocialFeedManager extends ClientObject
{
    /**
     * @return SocialActor
     */
    public function getOwner()
    {
        if (!$this->isPropertyAvailable("Owner")) {
            return null;
        }
        return $this->getProperty("Owner");
    }
    /**
     * @var SocialActor
     */
    public function setOwner($value)
    {
        $this->setProperty("Owner", $value, true);
    }
    /**
     * @return string
     */
    public function getPersonalSitePortalUri()
    {
        if (!$this->isPropertyAvailable("PersonalSitePortalUri")) {
            return null;
        }
        return $this->getProperty("PersonalSitePortalUri");
    }
    /**
     * @var string
     */
    public function setPersonalSitePortalUri($value)
    {
        $this->setProperty("PersonalSitePortalUri", $value, true);
    }
}
