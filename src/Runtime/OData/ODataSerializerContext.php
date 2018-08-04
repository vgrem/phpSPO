<?php


namespace Office365\PHP\Client\Runtime\OData;


use Office365\PHP\Client\Runtime\IEntityType;
use Office365\PHP\Client\Runtime\IEntityTypeCollection;


abstract class ODataSerializerContext
{
    public function __construct($metadataLevel)
    {
        $this->MetadataLevel = $metadataLevel;
    }

    /**
     * Maps response payload to client object
     * @param mixed $json
     * @param $resultObject
     */
    public function map($json,&$resultObject)
    {
        if ($this->RootElement && property_exists($json, $this->RootElement)) {
            $json = $json->{$this->RootElement};
            $this->RootElement = null;
        }

        if ($resultObject instanceof IEntityType) {
            if ($resultObject instanceof IEntityTypeCollection)
                $this->mapTypeCollection($json, $resultObject);
            else
                $this->mapType($json, $resultObject);
        }
        else
            $resultObject = $json;

    }



    /**
     * @param mixed $json
     * @param IEntityType $type
     */
    protected function mapType($json, $type)
    {
        foreach ($json as $key => $value) {
            if (is_object($value)) {
                $property = $type->getProperty($key);
                if ($property instanceof IEntityType) {
                    $this->map($value, $property);
                } else {
                    $type->setProperty($key, $value, false);
                }
            } else { //Primitive property?
                $type->setProperty($key, $value, false);
            }
        }
    }


    /**
     * @param $json
     * @param IEntityTypeCollection $resultTypeCollection
     */
    protected function mapTypeCollection($json, IEntityTypeCollection $resultTypeCollection)
    {
        $resultTypeCollection->clearData();
        foreach ($json as $item) {
            $type = $resultTypeCollection->createType();
            $this->mapType($item, $type);
            $resultTypeCollection->addChild($type);
        }
    }


    /**
     * Normalize request payload
     * @param IEntityType|array $value
     * @return array
     */
    public function normalize($value)
    {
        if ($value instanceof IEntityType) {
            $payload = array_map(function ($property) {
                return $this->normalize($property);
            }, $value->getProperties(SCHEMA_SERIALIZABLE_PROPERTIES));
            return $payload;
        } else if (is_array($value)) {
            return array_map(function ($item) {
                return $this->normalize($item);
            }, $value);
        }
        return $value;
    }



    /**
     * @return string
     */
    public abstract function getMediaType();


    /**
     * @return bool
     */
    public function isJson()
    {
       if($this instanceof JsonSerializerContext || $this instanceof JsonLightSerializerContext)
           return true;
        return false;
    }


    /**
     * @return bool
     */
    public function isAtom()
    {
        if($this instanceof AtomSerializerContext)
            return true;
        return false;
    }

    /**
     * Controls information from the payload
     * @var int
     */
    public $MetadataLevel;

    /**
     * @var string $RootElement
     */
    public $RootElement;

}