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
        $qry = new ClientQuery($this->getUrl() . "/add",ClientActionType::Create,$webCreationInformation);
        $this->getContext()->addQuery($qry,$web);
        $this->addChild($web);
        return $web;
    }
}