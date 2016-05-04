<?php
/**
 * Represents a local client object model version of a server-side property value.
 */

namespace SharePoint\PHP\Client;

use stdClass;

/**
 * @property stdClass __metadata
 */
class ClientValueObject
{

    public function __construct()
    {

    }
    
    public function setMetadataType($value)
    {
        $this->metadataType = $value;
    }


    protected function ensureMetadataType()
    {
        $this->__metadata = new stdClass();
        if(!isset($this->metadataType)){
            $className = explode("\\",get_class($this));
            $entityType = "SP." . end($className);
            $this->__metadata->type = $entityType;
        }
        else {
            $this->__metadata->type = $this->metadataType;
        }

    }


    public function toJson($rootElement=null)
    {
        $this->ensureMetadataType();
        $properties = (object) array_filter((array) $this);
        $payload = isset($rootElement) ? array($rootElement => $properties) : $properties;
        return json_encode($payload);
    }
    
    
    private $metadataType;

}