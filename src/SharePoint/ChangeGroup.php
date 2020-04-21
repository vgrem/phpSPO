<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T17:00:44+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObject;

/**
 * Specifies 
 * a change on a group.The RelativeTime property is not included in the default 
 * scalar property set for this type.
 */
class ChangeGroup extends ClientObject
{
    /**
     * @return integer
     */
    public function getGroupId()
    {
        if (!$this->isPropertyAvailable("GroupId")) {
            return null;
        }
        return $this->getProperty("GroupId");
    }
    /**
     * @var integer
     */
    public function setGroupId($value)
    {
        $this->setProperty("GroupId", $value, true);
    }
}