<?php

namespace SharePoint\PHP\Client;

/**
 * Web client object collection
 *
 */
class WebCollection extends ClientObjectCollection
{
    public function add(array $webCreationInformation)
    {
        $resoursePath = $this->getResourcePath() . "/add";
        $web = new Web($this->getContext(),$resoursePath,null,$webCreationInformation);
        $qry = new ClientQuery($web,ClientOperationType::Create);
        $this->getContext()->addQuery($qry);
        $this->addChild($web);
        return $web;
    }
}