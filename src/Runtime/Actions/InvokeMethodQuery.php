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
        parent::__construct($bindingType->getContext(),$bindingType,null);
        $this->MethodName = $methodName;
        $this->MethodParameters = $methodParameters;
        $this->BindingType->getQueryOptions()->clear();
    }

    /**
     * @return ResourcePath
     */
    public function getMethodPath(){
        return new ResourcePathServiceOperation($this->MethodName,$this->MethodParameters);
    }

    /**
     * @return string
     */
    public function getActionUrl()
    {
        if (!is_null($this->MethodName)) {
            if ($this->IsStatic) {
                $request = $this->getContext()->getPendingRequest();
                $entityTypeName = $request->normalizeTypeName($this->BindingType);
                $methodUrl = implode(".", array($entityTypeName, $this->getMethodPath()->toUrl()));
                return implode("", array($this->getContext()->getServiceRootUrl(), $methodUrl));
            } else {
                return implode("/", array($this->BindingType->getResourceUrl(), $this->getMethodPath()->toUrl()));
            }
        }
        return parent::getActionUrl();
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
