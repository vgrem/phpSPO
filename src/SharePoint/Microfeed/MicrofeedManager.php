<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T17:00:44+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint\Microfeed;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;

class MicrofeedManager extends ClientObject
{
    /**
     * @return MicroBlogEntity
     */
    public function getCurrentUser()
    {
        if (!$this->isPropertyAvailable("CurrentUser")) {
            return null;
        }
        return $this->getProperty("CurrentUser");
    }
    /**
     * @var MicroBlogEntity
     */
    public function setCurrentUser($value)
    {
        $this->setProperty("CurrentUser", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsFeedActivityPublic()
    {
        if (!$this->isPropertyAvailable("IsFeedActivityPublic")) {
            return null;
        }
        return $this->getProperty("IsFeedActivityPublic");
    }
    /**
     * @var bool
     */
    public function setIsFeedActivityPublic($value)
    {
        $this->setProperty("IsFeedActivityPublic", $value, true);
    }
    /**
     * @return string
     */
    public function getStaticThreadLink()
    {
        if (!$this->isPropertyAvailable("StaticThreadLink")) {
            return null;
        }
        return $this->getProperty("StaticThreadLink");
    }
    /**
     * @var string
     */
    public function setStaticThreadLink($value)
    {
        $this->setProperty("StaticThreadLink", $value, true);
    }
}
