<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00
 */
namespace Office365\OneDrive;

use Office365\Entity;

class ColumnLink extends Entity
{
    /**
     * @return string
     */
    public function getName()
    {
        if (!$this->isPropertyAvailable("Name")) {
            return null;
        }
        return $this->getProperty("Name");
    }
    /**
     * @var string
     */
    public function setName($value)
    {
        $this->setProperty("Name", $value, true);
    }
}