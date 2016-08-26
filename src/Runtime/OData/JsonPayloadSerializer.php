<?php


namespace Office365\PHP\Client\Runtime\OData;


use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ClientObjectCollection;
use Office365\PHP\Client\Runtime\ClientValueObject;
use Office365\PHP\Client\Runtime\ClientValueObjectCollection;
use Office365\PHP\Client\Runtime\Utilities\JsonConvert;
use stdClass;

class JsonPayloadSerializer
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
     * Deserializes JSON payload
     * @param string $value
     * @return null|ODataPayload
     */
    public function deserialize($value)
    {
        $jsonValue = JsonConvert::deserialize($value);
        $type = ODataPayloadKind::Entity;

        if($this->Format instanceof JsonLightFormat){
            if($this->Format->MetadataLevel == ODataMetadataLevel::Verbose){
                if(property_exists($jsonValue,"d")){
                    $jsonValue = $jsonValue->d;
                    $type = ODataPayloadKind::Entity;
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
        return new ODataPayload($jsonValue,$type);
    }


    /**
     * @param ODataPayload $payload
     * @param mixed $targetObject
     */
    public function populate(ODataPayload $payload,$targetObject){
        switch ($payload->PayloadType){
            case ODataPayloadKind::Collection:
                if($targetObject instanceof ClientValueObjectCollection)
                    $this->convertToClientValueObjectCollection($payload->Value,$targetObject);
                else
                    $this->convertToClientObjectCollection($payload->Value,$targetObject);
                break;
            case ODataPayloadKind::Entity:
                $this->convertToClientObject($payload->Value,$targetObject);
                break;
            case ODataPayloadKind::Property:
                $this->convertToClientValueObject($payload->getValue(),$targetObject);
                break;
            case ODataPayloadKind::Parameter:
                $targetObject->Value = $payload->getValue();
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
     * Converts the value of a complex type into a JSON light object
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


    private function convertToClientValueObjectCollection($items, ClientValueObjectCollection $targetObject)
    {
        $targetObject->clearData();
        foreach ($items as $item) {
            $clientValueObject = $targetObject->createTypedValueObject();
            $this->convertToClientValueObject($item,$clientValueObject);
            $targetObject->addChild($clientValueObject);
        }
    }


    /**
     * Converts the value of a entity
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
        if($this->Format instanceof JsonLightFormat && $this->Format->MetadataLevel == ODataMetadataLevel::Verbose){
            $metadataType = $payload->EntityType;
            if(substr( $metadataType, 0, 3 ) !== "SP.")
                $metadataType = "SP." . $metadataType;
            $payload->Value["__metadata"] = array("type" => $metadataType);
        }
        if(isset($payload->ContainerName)){
            $payload->Value = array( $payload->ContainerName => $payload->Value);
        }
        return JsonConvert::serialize($payload->Value);
    }

    /**
     * @var ODataFormat
     */
    public $Format;

}