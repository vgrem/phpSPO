<?php

/**
 * Updated By PHP Office365 Generator 2019-11-16T20:28:28+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint\WebParts;

use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ResourcePathEntity;

/**
 * Represents 
 * a Web 
 * Part on a Web Part Page. 
 * Provides operations for moving, deleting, and changing the state of the Web 
 * Part. The ZoneId property is not included in the default 
 * scalar property set for this type.
 */
class WebPartDefinition extends ClientObject
{
    public function saveWebPartChanges()
    {
        $qry = new InvokePostMethodQuery($this->getResourcePath(), "SaveWebPartChanges");
        $this->getContext()->addQuery($qry);
    }
    public function closeWebPart()
    {
        $qry = new InvokePostMethodQuery($this->getResourcePath(), "CloseWebPart");
        $this->getContext()->addQuery($qry);
    }
    /**
     * @return WebPart
     */
    public function getWebPart()
    {
        if (!$this->isPropertyAvailable('WebPart')) {
            $this->setProperty('WebPart', new WebPart($this->getContext(), new ResourcePathEntity($this->context,$this->getResourcePath(), "WebPart")));
        }
        return $this->getProperty('WebPart');
    }
    /**
     * Specifies 
     * the Web 
     * Part identifier of the Web Part.This value 
     * MUST be unique for each Web Part.
     * @return string
     */
    public function getId()
    {
        if (!$this->isPropertyAvailable("Id")) {
            return null;
        }
        return $this->getProperty("Id");
    }
    /**
     * Specifies 
     * the Web 
     * Part identifier of the Web Part.This value 
     * MUST be unique for each Web Part.
     * @var string
     */
    public function setId($value)
    {
        $this->setProperty("Id", $value, true);
    }
    /**
     * Gets the 
     * identifier of the WebPart Zone.
     * @return string
     */
    public function getZoneId()
    {
        if (!$this->isPropertyAvailable("ZoneId")) {
            return null;
        }
        return $this->getProperty("ZoneId");
    }
    /**
     * Gets the 
     * identifier of the WebPart Zone.
     * @var string
     */
    public function setZoneId($value)
    {
        $this->setProperty("ZoneId", $value, true);
    }
}
