<?php

namespace SharePoint\PHP\Client;

/**
 * Site resource
 */
class Site extends ClientObject
{
    /**
     * @return Web
     */
    public function getRootWeb()
    {
        if(!$this->isPropertyAvailable("RootWeb")){
            $this->setProperty("RootWeb", new Web($this->getContext(),$this->getResourcePath(),"rootWeb"));
        }
        return $this->getProperty("RootWeb");
    }


    /**
     * @return UserCustomActionCollection
     */
    public function getUserCustomActions()
    {
        if(!$this->isPropertyAvailable("UserCustomActions")){
            $this->setProperty("UserCustomActions", new UserCustomActionCollection($this->getContext(),$this->getResourcePath(),"UserCustomActions"));
        }
        return $this->getProperty("UserCustomActions");
    }



}