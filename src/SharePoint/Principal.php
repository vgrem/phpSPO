<?php


namespace SharePoint\PHP\Client;


class Principal extends ClientObject
{

    /**
     * @return PrincipalType
     */
    public function getPrincipalType()
    {
        if($this->isPropertyAvailable('PrincipalType')){
            return $this->getProperty("PrincipalType");
        }
        return null;
    }

}