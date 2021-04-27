<?php


namespace Office365\Runtime;


use Office365\Runtime\Http\RequestOptions;

/**
 * Represents a Service Operation result.
 */
class ClientResult
{

    /**
     *
     * @param ClientRuntimeContext $ctx
     * @param ClientObject|ClientValue|int|bool|string|null $returnValue
     */
    function __construct($ctx, $returnValue=null)
    {
        $this->context = $ctx;
        $this->value = $returnValue;
    }

    public function setProperty($key, $value){
        if($this->value instanceof ClientObject || $this->value instanceof ClientValue) {
            $this->value->setProperty($key,$value,False);
        }
        else {
            $this->value = $value;
        }
    }

    /**
     * @return RequestOptions
     */
    public function buildRequest(){
        return $this->context->buildRequest();
    }


    /**
     * @return $this
     */
    public function executeQuery(){
        $this->context->executeQuery();
        return $this;
    }


    public function getValue(){
        return $this->value;
    }

    /**
     * @var $value
     */
    protected $value;

    /**
     * @var ClientRuntimeContext
     */
    protected $context;

}
