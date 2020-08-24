<?php


namespace Office365\Runtime\Actions;


use Office365\Runtime\ClientObject;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\ResourcePathServiceOperation;


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
     * @return ResourcePath
     */
    public function toResourcePath(){
        return new ResourcePathServiceOperation($this->MethodName,$this->MethodParameters);
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
