<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;
class WorkbookRangeFill extends Entity
{
    /**
     * @return string
     */
    public function getColor()
    {
        if (!$this->isPropertyAvailable("Color")) {
            return null;
        }
        return $this->getProperty("Color");
    }
    /**
     * @var string
     */
    public function setColor($value)
    {
        $this->setProperty("Color", $value, true);
    }
}