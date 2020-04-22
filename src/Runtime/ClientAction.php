<?php

namespace Office365\Runtime;



/**
 * OData query class
 */
class ClientAction
{

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

