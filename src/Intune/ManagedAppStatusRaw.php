<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Intune;

use Office365\Common\Json;
use Office365\Runtime\ClientObject;

class ManagedAppStatusRaw extends ClientObject
{
    /**
     * @return Json
     */
    public function getContent()
    {
        if (!$this->isPropertyAvailable("Content")) {
            return null;
        }
        return $this->getProperty("Content");
    }
    /**
     * @var Json
     */
    public function setContent($value)
    {
        $this->setProperty("Content", $value, true);
    }
}