<?php

/**
 * Modified: 2020-05-24T21:39:44+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

class RestrictedSignIn extends ClientObject
{
    /**
     * @return string
     */
    public function getTargetTenantId()
    {
        if (!$this->isPropertyAvailable("TargetTenantId")) {
            return null;
        }
        return $this->getProperty("TargetTenantId");
    }
    /**
     * @var string
     */
    public function setTargetTenantId($value)
    {
        $this->setProperty("TargetTenantId", $value, true);
    }
}