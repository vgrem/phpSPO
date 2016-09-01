<?php


namespace Office365\PHP\Client\OutlookServices;
use Office365\PHP\Client\Runtime\OData\ODataPayload;
use Office365\PHP\Client\Runtime\OData\ODataPayloadKind;

class OperationParameterCollection extends ODataPayload
{
    function __construct()
    {
        $this->parameters = array();
    }

    function add($name, $value)
    {
        $this->parameters{$name} = $value;
    }

    /**
     * Gets entity type name
     * @return string
     */
    function getEntityTypeName()
    {
        return null;
    }


    /**
     * @return int
     */
    function getPayloadType()
    {
        return ODataPayloadKind::Parameter;
    }

    /**
     * Converts JSON into payload
     * @param mixed $json
     */
    function convertFromJson($json)
    {
        foreach ($json as $key => $value)
            $this->parameters[$key] = $value;
    }


    function  convertToJson()
    {
        return array_map(function ($p) {
            return $this->mapToJson($p);
        }, $this->parameters);
    }


    /**
     * @var array
     */
    private $parameters;

}