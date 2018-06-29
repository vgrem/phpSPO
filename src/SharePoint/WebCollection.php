<?php

namespace Office365\PHP\Client\SharePoint;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\ClientObjectCollection;


/**
 * Web client object collection
 *
 */
class WebCollection extends ClientObjectCollection
{

    /**
     * @param WebCreationInformation $webCreationInformation
     * @return Web
     */
    public function add(WebCreationInformation $webCreationInformation)
    {
        $web = new Web($this->getContext(),$this->getResourcePath());
        $qry = new InvokePostMethodQuery(
            $this->getResourcePath(),
            "Add",
            null,
            $webCreationInformation
        );
        $this->getContext()->addQuery($qry,$web);
        $this->addChild($web);
        return $web;
    }
}