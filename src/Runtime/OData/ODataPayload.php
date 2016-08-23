<?php

namespace Office365\PHP\Client\Runtime\OData;


use stdClass;

class ODataPayload
{

    /**
     * ODataPayload constructor.
     * @param mixed $value
     * @param int $payloadType
     * @param string $entityType
     */
    function __construct($value, $payloadType, $entityType)
    {
        $this->value = $value;
        $this->PayloadType = $payloadType;
        $this->EntityType = $entityType;
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
     * @param ODataFormat $format
     * @return mixed
     */
    public function getFormattedValue(ODataFormat $format){
        if($format->MetadataLevel == ODataMetadataLevel::Verbose){
            $metadata = new stdClass();
            $metadata->type = $this->EntityType;
            if(substr( $metadata->type, 0, 3 ) !== "SP.")
                $metadata->type = "SP." . $metadata->type;
            $this->value->__metadata = $metadata;
        }
        if(isset($this->ContainerName)){
            $value = new stdClass();
            $value->{$this->ContainerName} = $this->value;
            return $value;
        }
        return $this->value;
    }


    /**
     * @return mixed
     */
    public function getValue(){
        if(isset($this->ContainerName))
            return $this->value->{$this->ContainerName};
        return $this->value;
    }


    public function isRawValue()
    {
        if(is_string($this->value))
            return true;
        return false;
    }


    /**
     * @var mixed
     */
    private $value;

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

}