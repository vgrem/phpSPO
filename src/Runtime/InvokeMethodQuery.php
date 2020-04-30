<?php


namespace Office365\Runtime;


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
    public function getMethodPath()
    {
        if ($this->MethodName) {
            if($this->IsStatic){
                $staticMethodName = implode(".", array("SP", $this->BindingType->getTypeName(), $this->MethodName));
                return new ResourcePathServiceOperation($staticMethodName,
                    $this->MethodParameters);
            }
            return new ResourcePathServiceOperation($this->MethodName,
                $this->MethodParameters,
                $this->BindingType->getResourcePath());
        }
        return null;
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
