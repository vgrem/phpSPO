<?php


namespace Office365\PHP\Client\Runtime;
use Office365\PHP\Client\Runtime\OData\ODataSerializerContext;


/**
 * Represents a Service Operation result value.
 */
class ClientResult
{

    function __construct($returnValue=null)
    {
        $this->Value = $returnValue;
    }

    /**
     * @return null|string
     */
    public function getType(){
        if(!is_null($this->Value))
        {
            if($this->Value instanceof IEntityType)
                return $this->Value->getTypeName();
            return basename(get_class($this->Value));
        }
        return null;
    }


    /**
     * @param $json
     * @param ODataSerializerContext $serializationContext
     */
    public function fromJson($json, ODataSerializerContext $serializationContext)
    {
        $serializationContext->map($json, $this->Value);
    }

    /**
     * @var mixed $Value
     */
    public $Value;

}