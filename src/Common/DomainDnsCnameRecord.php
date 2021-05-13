<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

class DomainDnsCnameRecord extends ClientObject
{
    /**
     * @return string
     */
    public function getCanonicalName()
    {
        if (!$this->isPropertyAvailable("CanonicalName")) {
            return null;
        }
        return $this->getProperty("CanonicalName");
    }
    /**
     * @var string
     */
    public function setCanonicalName($value)
    {
        $this->setProperty("CanonicalName", $value, true);
    }
}