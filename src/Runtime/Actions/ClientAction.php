<?php

namespace Office365\Runtime\Actions;


use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientResult;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ClientValue;

/**
 * OData query class
 */
abstract class ClientAction
{

    /**
     * @param ClientRuntimeContext $context
     * @param ClientObject|null $bindingType
     * @param ClientObject|ClientValue|ClientResult $returnType
     */
    public function __construct($context, $bindingType,$returnType)
    {
        $this->context = $context;
        $this->BindingType = $bindingType;
        $this->ReturnType = $returnType;
    }


    /**
     * @return ClientRuntimeContext
     */
    public function getContext(){
        return $this->context;
    }

    /**
     * @return string
     */
    public function getId(){
        return spl_object_hash($this);
    }


    /**
     * Build action url
     * @return string
     */
    public function getActionUrl()
    {
        return $this->BindingType->getResourceUrl();
    }


    /**
     * @var ClientRuntimeContext
     */
    private $context;

    /**
     * @var ClientObject
     */
    public $BindingType;

    /**
     * @var ClientObject
     */
    public $ReturnType;

}

