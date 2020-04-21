<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T16:35:02+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObject;

/**
 * Represents 
 * navigation operations at the site collection 
 * level. 
 */
class Navigation extends ClientObject
{
    /**
     * @return bool
     */
    public function getUseShared()
    {
        if (!$this->isPropertyAvailable("UseShared")) {
            return null;
        }
        return $this->getProperty("UseShared");
    }
    /**
     * @var bool
     */
    public function setUseShared($value)
    {
        $this->setProperty("UseShared", $value, true);
    }
}