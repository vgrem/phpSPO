<?php

namespace SharePoint\PHP\Client\Runtime;


use SharePoint\PHP\Client\ClientObject;

abstract class ODataEntity
{
    /**
     * @return string
     */
    function getEntityTypeName()
    {
        return get_called_class();
    }


    /**
     * @param string $key
     * @return bool
     */
    protected function isMetadataProperty($key){
        return $key == "__metadata";
    }

    /**
     * @param mixed $payload
     * @param ODataFormat $format
     */
    function convertToEntity($payload, ODataFormat $format)
    {
        foreach ($payload as $key => $value) {
            if ($this->isMetadataProperty($key)) {
                continue;
            }
            if (is_object($value)) {
                if (isset($value->__deferred)) { //deferred property
                    $this->{$key} = null;
                }
                else {
                    $propertyObject = $this->{$key};
                    if ($propertyObject instanceof ClientObject) {
                        $propertyObject->convertToEntity($value, $format);
                    }
                }
            }
            else {
                $this->{$key} = $value;
            }
        }
    }




    /**
     * @return \stdClass
     */
    abstract function convertToPayload();

    /**
     * @return int
     */
    abstract function getPayloadType();

}