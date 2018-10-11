<?php

namespace Office365\PHP\Client\Runtime\CSOM;

use Office365\PHP\Client\Runtime\ClientAction;
use SimpleXMLElement;

class ObjectIdentityQuery extends ClientAction  implements ICSOMCallable
{

    function buildQuery(SimpleXMLElement $writer)
    {
        $query = $writer->addChild("ObjectIdentityQuery");
        $query->addAttribute("Id", $this->getId());
        $query->addAttribute("ObjectPathId", $this->getResourcePath()->Id);
    }
}