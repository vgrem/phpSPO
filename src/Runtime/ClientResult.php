<?php


namespace Office365\PHP\Client\Runtime;


/**
 * Represents a Service Operation result value.
 */
class ClientResult
{

    function __construct($functionName, $returnValue=null)
    {
        $this->FunctionName = $functionName;
        $this->Value = $returnValue;
    }

    /**
     * @return null|string
     */
    public function getType(){
        if(!is_null($this->Value))
        {
            if($this->Value instanceof ISchemaType)
                return $this->Value->getTypeName();
            return basename(get_class($this->Value));
        }
        return null;
    }


    /**
     * @var string $FunctionName
     */
    public $FunctionName;

    /**
     * @var mixed $Value
     */
    public $Value;

}