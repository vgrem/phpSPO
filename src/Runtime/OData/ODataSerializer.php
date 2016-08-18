<?php


namespace SharePoint\PHP\Client\Runtime;

use SharePoint\PHP\Client\RequestOptions;
use stdClass;

class ODataSerializer
{

    /**
     * ODataSerializer constructor.
     * @param ODataFormat $format
     */
    function __construct(ODataFormat $format)
    {
        $this->Format = $format;
    }


    public function setMediaTypeHeaders(RequestOptions $request) {
        $request->addCustomHeader("Accept",$this->Format->getMediaType());
        $request->addCustomHeader("Content-type",$this->Format->getMediaType());
    }


    /**
     * @return ODataFormat
     */
    public function getFormat()
    {
        return $this->Format;
    }


    /**
     * Creates OData entity from payload
     * @param string $payload
     * @param ODataEntity $targetEntity
     */
    public function deserialize($payload, ODataEntity $targetEntity)
    {
        if($this->Format->isJson()) {
            $payload = JsonConvert::deserialize($payload);
            //parse json payload
            $payload = $this->parseJsonPayload($payload);
            $targetEntity->convertToEntity($payload,$this->Format);
            //$this->populate($value,$targetEntity);
        }
    }


    /**
     * Generates payload for serialization
     * @param ODataEntity $entity
     * @return string
     */
    public function serialize(ODataEntity $entity)
    {
        if($this->Format->isJson()) {
            $payload = $entity->convertToPayload();

            if($this->Format->MetadataLevel == ODataMetadataLevel::Verbose){
                $metadata = new stdClass();
                $metadata->type = $entity->getEntityTypeName();
                if(substr( $metadata->type, 0, 3 ) !== "SP.")
                    $metadata->type = "SP." . $metadata->type;

                if(property_exists($payload,"parameters"))
                    $payload->parameters->__metadata = $metadata;
                else if(property_exists($payload,"query"))
                    $payload->query->__metadata = $metadata;
                else
                    $payload->__metadata = $metadata;

            }
            return JsonConvert::serialize($payload);
        }
        return null;
    }


    /**
     * @param stdClass $payload
     * @return stdClass
     */
    private function parseJsonPayload(stdClass $payload){
        //parse json payload
        if($this->Format instanceof JsonLightFormat){
            if($this->Format->MetadataLevel == ODataMetadataLevel::Verbose){
                if(property_exists($payload,"d"))
                    $payload = $payload->d;
                if(property_exists($payload,"results"))
                    $payload = $payload->results;
            }
            else {
                if(property_exists($payload,"value"))
                    $payload = $payload->value;
            }
        }
        else {
            if($this->Format->MetadataLevel == ODataMetadataLevel::Verbose && property_exists($payload,"value")) {
                $payload = $payload->value;
            }
        }
        return $payload;
    }

    /**
     * @var ODataFormat
     */
    public $Format;

}