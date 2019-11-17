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
 * Used to 
 * return data from Connector operations in a specific format
 */
class ConnectorResult extends ClientObject
{
    /**
     * @return string
     */
    public function getContextData()
    {
        if (!$this->isPropertyAvailable("ContextData")) {
            return null;
        }
        return $this->getProperty("ContextData");
    }
    /**
     * @var string
     */
    public function setContextData($value)
    {
        $this->setProperty("ContextData", $value, true);
    }
    /**
     * @return string
     */
    public function getValue()
    {
        if (!$this->isPropertyAvailable("Value")) {
            return null;
        }
        return $this->getProperty("Value");
    }
    /**
     * @var string
     */
    public function setValue($value)
    {
        $this->setProperty("Value", $value, true);
    }
}