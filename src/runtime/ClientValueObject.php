<?php
/**
 * Represents a local client object model version of a server-side property value.
 */

namespace SharePoint\PHP\Client;

use JsonSerializable;
use ReflectionClass;
use ReflectionProperty;
use stdClass;


class ClientValueObject implements JsonSerializable
{

    public function __construct()
    {

    }
    
    
    public function setMetadataType($value)
    {
        $this->metadataType = $value;
    }


    protected function ensureMetadataType(stdClass $entity)
    {
        $entity->__metadata = new stdClass();
        if(!isset($this->metadataType)){
            $className = explode("\\",get_class($this));
            $entityType = "SP." . end($className);
            $entity->__metadata->type = $entityType;
        }
        else {
            $entity->__metadata->type = $this->metadataType;
        }
    }

    public function fromJson($json)
    {
        foreach ($json as $key => $value) {
            $this->$key = $value;
        }
        if(isset($json->__metadata))
            $this->metadataType = $json->__metadata->type;
    }

    public function toJson()
    {
        return json_encode($this);
    }

    /**
     * Specifies client value object properties which should be serialized to JSON
     */
    function jsonSerialize()
    {
        $reflection = new ReflectionClass($this);
        $allProps   = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
        $entity = new stdClass();
        foreach($allProps as $p){
            $k = $p->getName();
            $v = $p->getValue($this);
            if(isset($v)){
                $entity->{$k} = $v;
            }
        }
        $this->ensureMetadataType($entity);
        return $entity;
    }
    
    
    private $metadataType;


}