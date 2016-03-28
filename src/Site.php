<?php

namespace SharePoint\PHP\Client;

/**
 * Web client object
 */
class Site extends ClientObject
{
    public function getRootWeb()
    {
        if(!isset($this->RootWeb)){
            $this->RootWeb = new Web($this->getContext(),"/_api/site/rootWeb");
        }
        return $this->RootWeb;
    }
}