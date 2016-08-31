<?php


namespace Office365\PHP\Client\Runtime;
use Office365\PHP\Client\Runtime\OData\ODataPayload;
use Office365\PHP\Client\Runtime\OData\ODataPayloadKind;


/**
 * Represents a primitive property value.
 */
class ClientResult extends ODataPayload
{

    /**
     * Converts JSON into payload property
     * @param mixed $json
     */
    function convertFromJson($json)
    {
        $this->Value = $json;
    }

    function getEntityTypeName()
    {
        return null;
    }


    function getPayloadType(){
        return ODataPayloadKind::Parameter;
    }

    /**
     * @var string
     */
    public $Value;



}