<?php

namespace Office365\Runtime\CSOM;

use Office365\Runtime\ClientAction;
use SimpleXMLElement;

class ObjectIdentityQuery extends ClientAction  implements ICSOMCallable
{

    function buildQuery(SimpleXMLElement $writer)
    {
        $query = $writer->addChild("ObjectIdentityQuery");
        $query->addAttribute("Id", $this->getId());
        //$query->addAttribute("ObjectPathId", $this->getBindingType()->Id);
    }
}