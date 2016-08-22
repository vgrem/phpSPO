<?php

namespace SharePoint\PHP\Client;


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
        $qry = new ClientActionInvokePostMethod(
            $this,
            "Add",
            null,
            $webCreationInformation->convertToPayload()
        );
        $this->getContext()->addQuery($qry,$web);
        $this->addChild($web);
        return $web;
    }
}