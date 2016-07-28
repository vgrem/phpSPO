<?php

namespace SharePoint\PHP\Client;


/**
 * Web client object collection
 *
 */
class WebCollection extends ClientObjectCollection
{
    
    public function add(WebCreationInformation $webCreationInformation)
    {
        $web = new Web($this->getContext());
        $qry = new ClientActionInvokePostMethod(
            $this,
            "Add",
            null,
            $webCreationInformation->toJson()
        );
        $this->getContext()->addQuery($qry,$web);
        $this->addChild($web);
        return $web;
    }
}