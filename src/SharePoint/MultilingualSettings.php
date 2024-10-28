<?php

/**
 * Generated  2024-10-28T19:27:51+00:00 16.0.25409.12005
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientObject;
class MultilingualSettings extends ClientObject
{
    /**
     * @return bool
     */
    public function getFollowLangPreference()
    {
        return $this->getProperty("FollowLangPreference");
    }
    /**
     * @var bool
     */
    public function setFollowLangPreference($value)
    {
        return $this->setProperty("FollowLangPreference", $value, true);
    }
}