<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T17:00:44+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
/**
 * Specifies 
 * a change from an alert.The RelativeTime property is not included in the default 
 * scalar property set for this type.
 */
class ChangeAlert extends ClientObject
{
    /**
     * @return string
     */
    public function getAlertId()
    {
        if (!$this->isPropertyAvailable("AlertId")) {
            return null;
        }
        return $this->getProperty("AlertId");
    }
    /**
     * @var string
     */
    public function setAlertId($value)
    {
        $this->setProperty("AlertId", $value, true);
    }
    /**
     * @return string
     */
    public function getWebId()
    {
        if (!$this->isPropertyAvailable("WebId")) {
            return null;
        }
        return $this->getProperty("WebId");
    }
    /**
     * @var string
     */
    public function setWebId($value)
    {
        $this->setProperty("WebId", $value, true);
    }
}