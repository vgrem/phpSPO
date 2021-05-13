<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00
 */
namespace Office365\Intune;

use Office365\Runtime\ClientObject;

class ManagedApp extends ClientObject
{
    /**
     * @return string
     */
    public function getVersion()
    {
        if (!$this->isPropertyAvailable("Version")) {
            return null;
        }
        return $this->getProperty("Version");
    }
    /**
     * @var string
     */
    public function setVersion($value)
    {
        $this->setProperty("Version", $value, true);
    }
}