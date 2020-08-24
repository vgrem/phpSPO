<?php

namespace Office365\Runtime\Actions;


use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientResult;
use Office365\Runtime\ClientValue;

/**
 * OData query class
 */
abstract class ClientAction
{

    /**
     * @param ClientObject $bindingType
     * @param ClientObject|ClientValue|ClientResult $returnType
     */
    public function __construct($bindingType,$returnType)
    {
        $this->BindingType = $bindingType;
        $this->ReturnType = $returnType;
    }

    /**
     * @return string
     */
    public function getId(){
        return spl_object_hash($this);
    }

    /**
     * @var ClientObject
     */
    public $BindingType;

    /**
     * @var ClientObject
     */
    public $ReturnType;

}

