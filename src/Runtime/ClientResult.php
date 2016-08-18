<?php


namespace SharePoint\PHP\Client;
use SharePoint\PHP\Client\Runtime\ODataEntity;
use SharePoint\PHP\Client\Runtime\ODataFormat;
use SharePoint\PHP\Client\Runtime\ODataMetadataLevel;
use SharePoint\PHP\Client\Runtime\ODataPayloadKind;


/**
 * Represents a primitive property value.
 */
class ClientResult extends ODataEntity
{


    function __construct()
    {
        $this->propertyName = ucfirst(debug_backtrace()[1]['function']);
    }


    function convertToEntity($payload, ODataFormat $format)
    {
        if($format->MetadataLevel == ODataMetadataLevel::Verbose){
            $this->Value = $payload->{$this->propertyName};
        }
        else
            $this->Value = $payload;
    }


    /**
     * @return \stdClass
     */
    function convertToPayload()
    {
        return null;
    }

    /**
     * @return int
     */
    function getPayloadType()
    {
        return ODataPayloadKind::Value;
    }


    /**
     * @var string
     */
    private $propertyName;

    /**
     * @var string
     */
    public $Value;
}