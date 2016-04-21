<?php

namespace SharePoint\PHP\Client;

/**
 * Web client object
 * @property Web RootWeb
 */
class Site extends ClientObject
{
    
    public function getRootWeb()
    {
        if(!$this->isPropertyAvailable('RootWeb')){
            $this->RootWeb = new Web($this->getContext(),$this->getResourcePath(),"rootWeb");
        }
        return $this->RootWeb;
    }
}