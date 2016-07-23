<?php

namespace SharePoint\PHP\Client;
use SharePoint\PHP\Client\Runtime\ODataQueryOptions;

/**
 * Web client object collection
 *
 */
class WebCollection extends ClientObjectCollection
{
    
    public function add(WebCreationInformation $webCreationInformation)
    {
        $web = new Web(
            $this->getContext(),
            new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"Add")
        );
        $qry = new ClientAction($web->getResourceUrl(),$webCreationInformation->toJson(),HttpMethod::Post);
        $this->getContext()->addQuery($qry,$web);
        $this->addChild($web);
        return $web;
    }
}