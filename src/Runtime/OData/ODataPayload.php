<?php

namespace Office365\PHP\Client\Runtime\OData;
use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ClientValueObject;


/**
 * Represents OData request/response payload
 */
abstract class ODataPayload
{


    static $DeferredFieldName = "__deferred";
    static $QueryFieldName = "query";
    static $ParametersFieldName = "parameters";
    static $ResultsFieldName = "results";
    static $MetadataFieldName  = "__metadata";
    static $SecurityTag = "d";

    /**
     * Converts OData entity/complex type into Json payload
     * @return array|mixed
     */
    public function convertToJson()
    {
        return $this->mapToJson($this);
    }

    /**
     * Converts OData entity/complex type into Json payload
     * @param $value
     * @return array|mixed
     */
    protected function mapToJson($value)
    {
        if (is_object($value)) {
            if ($value instanceof ClientValueObject) {
                $properties = get_object_vars($value);
                foreach (get_object_vars($value) as $key => $value) {
                    if(is_null($value) || ($key == "RootPropertyName"))
                        unset($properties[$key]);
                }
                return array_map(function ($p) {
                    return $this->mapToJson($p);
                }, $properties);
            } elseif ($value instanceOf ClientObject) {
                return array_map(function ($p) {
                    return $this->mapToJson($p);
                }, $value->getChangedProperties());
            }
        } elseif (is_array($value)) {
            return array_map(function ($item) {
                return $this->mapToJson($item);
            }, $value);
        }
        return $value;
    }

    /**
     * @return ODataPayload
     */
    public function toQueryPayload()
    {
        $this->RootPropertyName = "query";
        return $this;
    }


    public function toParametersPayload()
    {
        $this->RootPropertyName = "parameters";
        return $this;
    }


    /**
     * @param string $key
     * @return bool
     */
    protected function isMetadataProperty($key)
    {
        return $key == "__metadata";
    }

    protected function isDeferredProperty($value)
    {
        if (isset($value->__deferred))
            return true;
        return false;
    }


    /**
     * Gets entity type name
     * @return string
     */
    abstract function getEntityTypeName();


    /**
     * Converts JSON into payload
     * @param mixed $json
     */
    abstract function convertFromJson($json);

    /**
     * @return int
     */
    abstract function getPayloadType();


    /**
     * @var string
     */
    public $RootPropertyName;


}