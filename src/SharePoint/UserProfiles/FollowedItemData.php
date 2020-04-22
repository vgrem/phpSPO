<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T17:00:44+00:00 16.0.19506.12022
 */
namespace Office365\SharePoint\UserProfiles;

use Office365\Runtime\ClientObject;
use Office365\SharePoint\KeyValueCollection;


class FollowedItemData extends ClientObject
{
    /**
     * @return KeyValueCollection
     */
    public function getProperties()
    {
        if (!$this->isPropertyAvailable("Properties")) {
            return null;
        }
        return $this->getProperty("Properties");
    }
    /**
     * @var KeyValueCollection
     */
    public function setProperties($value)
    {
        $this->setProperty("Properties", $value, true);
    }
}
