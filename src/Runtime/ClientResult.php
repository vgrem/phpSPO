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


    public function getValue(){
        return $this->value;
    }

    public function setValue($value){
        $this->value = $value;
    }

    /**
     * @var $value
     */
    protected $value;

}
