<?php


namespace Office365\PHP\Client\Runtime\OData;


use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ClientObjectCollection;
use Office365\PHP\Client\Runtime\ClientResult;
use Office365\PHP\Client\Runtime\ClientValueObject;
use Office365\PHP\Client\Runtime\Utilities\JsonConvert;
use stdClass;

class ODataPayloadSerializer
{

    /**
     * ODataSerializer constructor.
     * @param ODataFormat $format
     */
    function __construct(ODataFormat $format)
    {
        $this->Format = $format;
    }


    /**
     * Creates OData entity from payload
     * @param string $value
     * @return null|ODataPayload
     */
    public function deserialize($value)
    {
        return $this->parseJsonPayload($value);
    }


    /**
     * @param string $value
     * @param mixed $targetObject
     * @param callable|null $onPopulate
     */
    public function populate($value,$targetObject,callable $onPopulate = null){
        $payload = $this->deserialize($value);
        if($targetObject instanceof ClientResult){
            if($this->Format->MetadataLevel == ODataMetadataLevel::Verbose){
                $payload->ContainerName = $targetObject->FunctionName;
            }
            $targetObject->Value = $payload->getValue();
            return;
        }

        if(is_callable($onPopulate))
            call_user_func_array($onPopulate,array($payload,$this->Format));
        //convert
        switch ($payload->PayloadType){
            case ODataPayloadKind::Collection:
                $this->convertToClientObjectCollection($payload->getValue(),$targetObject);
                break;
            case ODataPayloadKind::Entry:
                $this->convertToClientObject($payload->getValue(),$targetObject);
                break;
            case ODataPayloadKind::Property:
                $this->convertToClientValueObject($payload->getValue(),$targetObject);
                break;
        }
    }


    private function convertToClientObjectCollection($items, ClientObjectCollection $targetObject)
    {
        $targetObject->clearData();
        foreach ($items as $item) {
            $clientObject = $targetObject->createTypedObject();
            $this->convertToClientObject($item,$clientObject);
            $targetObject->addChild($clientObject);
        }
    }

    /**
     * Converts the value of a complex property in a JSON light object
     * @param stdClass $properties
     * @param ClientValueObject $targetObject
     */
    private function convertToClientValueObject(stdClass $properties,ClientValueObject $targetObject)
    {
        foreach ($properties as $key => $value) {
            if ($this->isMetadataProperty($key)) {
                continue;
            }
            if (is_object($value)) {
                if (isset($value->__deferred)) { //deferred property
                    $targetObject->{$key} = null;
                }
                else {
                    if(property_exists($value,"results")) //collection of properties?
                        $targetObject->{$key} = $value->results;
                }
            }
            else {
                $targetObject->{$key} = $value;
            }
        }
    }


    /**
     * @param stdClass $item
     * @param ClientObject $targetObject
     */
    function convertToClientObject(stdClass $item,ClientObject $targetObject)
    {
        foreach ($item as $key => $value) {
            if ($this->isMetadataProperty($key)) {
                continue;
            }
            if (is_object($value)) {
                if ($this->isDeferredProperty($value)) { //deferred property
                    $targetObject->setProperty($key,null,false);
                }
                else {
                    $propertyObject = $targetObject->getProperty($key);
                    if ($propertyObject instanceof ClientObject) {
                        $this->convertToClientObject($value,$propertyObject);
                    }


                }
            }
            else {
                $targetObject->setProperty($key,$value,false);
            }
        }
    }


    /**
     * @param string $key
     * @return bool
     */
    private function isMetadataProperty($key){
        return $key == "__metadata";
    }

    private function isDeferredProperty($value){
        if(isset($value->__deferred))
            return true;
        return false;
    }


    /**
     * Generates payload for serialization
     * @param ODataPayload $payload
     * @return string
     */
    public function serialize(ODataPayload $payload)
    {
        $value = $payload->getFormattedValue($this->Format);
        return JsonConvert::serialize($value);
    }


    /**
     * @param string $value
     * @return ODataPayload
     */
    private function parseJsonPayload($value){
        $jsonValue = JsonConvert::deserialize($value);
        $type = ODataPayloadKind::Entry;

        if($this->Format instanceof JsonLightFormat){
            if($this->Format->MetadataLevel == ODataMetadataLevel::Verbose){
                if(property_exists($jsonValue,"d")){
                    $jsonValue = $jsonValue->d;
                    $type = ODataPayloadKind::Entry;
                }
                if(property_exists($jsonValue,"results")) {
                    $jsonValue = $jsonValue->results;
                    $type = ODataPayloadKind::Collection;
                }
            }
            else {
                if(property_exists($jsonValue,"value")) {
                    $jsonValue = $jsonValue->value;
                    $type = ODataPayloadKind::Collection;
                }
            }
        }
        else {
            if($this->Format->MetadataLevel == ODataMetadataLevel::Verbose && property_exists($jsonValue,"value")) {
                $jsonValue = $jsonValue->value;
                $type = ODataPayloadKind::Collection;
            }
        }
        return new ODataPayload($jsonValue,$type,null);
    }

    /**
     * @var ODataFormat
     */
    public $Format;

}