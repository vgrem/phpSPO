<?php

namespace Office365\PHP\Client\Runtime\OData;


use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ClientValueObject;
use Office365\PHP\Client\Runtime\FormatType;

/**
 * Represents OData request/response payload
 */
class ODataPayload
{

    /**
     * ODataPayload constructor.
     * @param mixed $value
     * @param int $payloadType
     * @param string $entityType
     */
    function __construct($value, $payloadType, $entityType = null)
    {
        $this->Value = $value;
        $this->PayloadType = $payloadType;
        $this->EntityType = $entityType;
        $this->DataFormat = FormatType::Json;
    }


    /**
     * Creates OData payload from OData entity/complex type
     * @param ClientObject|ClientValueObject $object
     * @return ODataPayload
     */
    static function createFromObject($object)
    {
        $jsonValue = self::mapToJson($object);
        if($object instanceof ClientObject)
            return new ODataPayload($jsonValue,ODataPayloadKind::Entity,$object->getEntityTypeName());
        elseif ($object instanceOf ClientValueObject)
            return new ODataPayload($jsonValue,ODataPayloadKind::Property,$object->getEntityTypeName());
        return null;
    }



    /**
     * Converts OData entity/complex type into Json payload
     * @param $value
     * @return array|mixed
     */
    private static function mapToJson($value) {
        if (is_object($value)){
            if($value instanceof ClientValueObject) {
                $properties = array_filter(get_object_vars($value), function($var){
                    return !is_null($var);
                });
                return array_map(function ($p) {
                    return self::mapToJson($p);
                }, $properties);
            }
            elseif ($value instanceOf ClientObject){
                return array_map(function ($value) {
                    return self::mapToJson($value);
                }, $value->getChangedProperties());
            }
        }
        elseif (is_array($value)) {
            return array_map(function ($value) {
                return self::mapToJson($value);
            }, $value);
        }
        else {
            return $value;
        }
    }

    /**
     * @return ODataPayload
     */
    public function toQueryPayload(){
        $this->ContainerName = "query";
        return $this;
    }


    public function toParametersPayload(){
        $this->ContainerName = "parameters";
        return $this;
    }


    /**
     * Determines whether payload is a raw value or not
     * @return bool
     */
    public function isRawValue()
    {
        if(is_string($this->Value))
            return true;
        return false;
    }


    /**
     * Gets payload value
     * @return mixed
     */
    public function getValue(){
        if(isset($this->ContainerName))
            return $this->Value->{$this->ContainerName};
        return $this->Value;
    }


    /**
     * @var mixed
     */
    public $Value;

    /**
     * @var int
     */
    public $PayloadType;


    /**
     * @var string
     */
    public $EntityType;


    /**
     * @var string
     */
    public $ContainerName;


    /**
     * @var int
     */
    public $DataFormat;

}