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
        $this->value = $returnValue;
    }

    /**
     * @return null|string
     */
    public function getType(){
        if(!is_null($this->value))
        {
            if($this->value instanceof IEntityType)
                return $this->value->getTypeName();
            return basename(get_class($this->value));
        }
        return null;
    }


    /**
     * @param $json
     * @param ODataSerializerContext $serializationContext
     */
    public function fromJson($json, ODataSerializerContext $serializationContext)
    {
        $serializationContext->map($json, $this->value);
    }


    public function getValue(){
        return $this->value;
    }

    /**
     * @var mixed $value
     */
    protected $value;




}