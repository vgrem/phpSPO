<?php


namespace Office365\Runtime\Actions;


use Office365\Runtime\ClientObject;
use Office365\Runtime\Paths\ServiceOperationPath;
use Office365\Runtime\ResourcePath;


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
    public function getPath(){
        if ($this->IsStatic) {
            $entityTypeName = (string)$this->BindingType->getServerTypeInfo();
            $staticName = implode(".",[$entityTypeName, $this->MethodName]);
            return new ServiceOperationPath($staticName,$this->MethodParameters);
        }
        return new ServiceOperationPath($this->MethodName, $this->MethodParameters);
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        if(is_null($this->MethodName)){
            return parent::getUrl();
        }

        if ($this->IsStatic) {
            return implode("", [$this->getContext()->getServiceRootUrl(), $this->getPath()->toUrl()]);
        }
        return implode("", [$this->BindingType->getResourceUrl(), $this->getPath()->toUrl()]);
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
