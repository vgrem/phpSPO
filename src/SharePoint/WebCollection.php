<?php

namespace Office365\SharePoint;
use Office365\Runtime\InvokePostMethodQuery;
use Office365\Runtime\ClientObjectCollection;


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
            $this,
            "Add",
            null,
            "parameters",
            $webCreationInformation
        );
        $this->getContext()->addQueryAndResultObject($qry,$web);
        $this->addChild($web);
        return $web;
    }
}