<?php

/**
 * Generated  2024-02-24T10:21:51+00:00 16.0.24607.12008
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientObject;
use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\Actions\UpdateEntityQuery;
class SPPlaylist_Subscriber extends BaseEntity
{
    /**
     * @return bool
     */
    public function getisUserSubscribed()
    {
        return $this->getProperty("isUserSubscribed");
    }
    /**
     * @var bool
     */
    public function setisUserSubscribed($value)
    {
        return $this->setProperty("isUserSubscribed", $value, true);
    }
}