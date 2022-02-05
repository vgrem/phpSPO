<?php

namespace Office365\SharePoint;

use Office365\Runtime\ClientValueCollection;
use Office365\Runtime\ServerTypeInfo;

class FieldMultiChoiceValue extends ClientValueCollection
{

    /**
     * @param string[] $choices
     */
    public function __construct($choices)
    {
        parent::__construct("string");
        foreach ($choices as $choice) {
            $this->addChild($choice);
        }
    }

    public function toJson()
    {
        return array('results' => $this->getData());
    }

    public function getServerTypeInfo()
    {
        return ServerTypeInfo::primitive("string",true);
    }

}