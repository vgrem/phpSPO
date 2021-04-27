<?php


namespace Office365\SharePoint;

use Office365\Runtime\Auth\ClientCredential;
use Office365\Runtime\Auth\UserCredentials;
use Office365\Runtime\ClientObject;

/**
 * SharePoint specific entity
 */
class BaseEntity extends ClientObject
{

    /**
     * @return ClientContext
     */
    public function getContext()
    {
        if($this->context instanceof ClientContext)
            return $this->context;
        return null;
    }

    /**
     * @param ClientCredential|UserCredentials $credentials
     * @return $this
     */
    public function withCredentials($credentials)
    {
        $this->getContext()->withCredentials($credentials);
        return $this;
    }

}