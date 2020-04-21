<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T17:00:44+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint\Social;

use Office365\PHP\Client\Runtime\ClientObject;


class SocialRestFeed extends ClientObject
{
    /**
     * @return SocialFeed
     */
    public function getSocialFeed()
    {
        if (!$this->isPropertyAvailable("SocialFeed")) {
            return null;
        }
        return $this->getProperty("SocialFeed");
    }
    /**
     * @var SocialFeed
     */
    public function setSocialFeed($value)
    {
        $this->setProperty("SocialFeed", $value, true);
    }
}
