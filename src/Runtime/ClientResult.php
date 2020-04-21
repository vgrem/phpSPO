<?php


namespace Office365\PHP\Client\Runtime;

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
     * @param array $json
     */
    public function mapJson($json){
        if($this->value instanceof ClientObject || $this->value instanceof ClientValueObject)
            $this->value->mapJson($json);
        else
            $this->value = $json;
    }

    public function getValue(){
        return $this->value;
    }

    /**
     * @var $value
     */
    protected $value;

}
