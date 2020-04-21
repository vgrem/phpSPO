<?php


namespace Office365\PHP\Client\Runtime;


class InvokeMethodQuery extends ClientAction
{

    /**
     * @param ClientObject $bindingType
     * @param string $methodName
     * @param array $methodParameters
     */
    public function __construct($bindingType, $methodName=null, $methodParameters=null)
    {
        parent::__construct($bindingType,null);
        $this->MethodName = $methodName;
        $this->MethodParameters = $methodParameters;
    }





    /**
     * @return ResourcePathServiceOperation
     */
    public function getResourcePath()
    {
        return new ResourcePathServiceOperation($this->MethodName, $this->MethodParameters);
    }


    /**
     * @var string
     */
    public $TypeId;


    /**
     * @var $IsStatic boolean
     */
    public $IsStatic;


    /**
     * @var string|null
     */
    public $MethodName;

    /**
     * @var array|null
     */
    public $MethodParameters;

}
