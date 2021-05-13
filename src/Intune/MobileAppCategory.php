<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00
 */
namespace Office365\Intune;

use Office365\Entity;


class MobileAppCategory extends Entity
{
    /**
     * @return string
     */
    public function getDisplayName()
    {
        if (!$this->isPropertyAvailable("DisplayName")) {
            return null;
        }
        return $this->getProperty("DisplayName");
    }
    /**
     * @var string
     */
    public function setDisplayName($value)
    {
        $this->setProperty("DisplayName", $value, true);
    }
}