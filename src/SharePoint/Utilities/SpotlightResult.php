<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T18:33:00+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint\Utilities;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
/**
 * Contains 
 * the result of a spotlight operation, such as AddToSpotlight or RemoveFromSpotlight, 
 * and also contains the updated set of items in the spotlight.
 */
class SpotlightResult extends ClientObject
{
    /**
     * @return array
     */
    public function getOrder()
    {
        if (!$this->isPropertyAvailable("Order")) {
            return null;
        }
        return $this->getProperty("Order");
    }
    /**
     * @var array
     */
    public function setOrder($value)
    {
        $this->setProperty("Order", $value, true);
    }
    /**
     * @return integer
     */
    public function getResultCode()
    {
        if (!$this->isPropertyAvailable("ResultCode")) {
            return null;
        }
        return $this->getProperty("ResultCode");
    }
    /**
     * @var integer
     */
    public function setResultCode($value)
    {
        $this->setProperty("ResultCode", $value, true);
    }
}