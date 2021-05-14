<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;

class WorkbookRangeBorder extends Entity
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
    /**
     * @return string
     */
    public function getSideIndex()
    {
        if (!$this->isPropertyAvailable("SideIndex")) {
            return null;
        }
        return $this->getProperty("SideIndex");
    }
    /**
     * @var string
     */
    public function setSideIndex($value)
    {
        $this->setProperty("SideIndex", $value, true);
    }
    /**
     * @return string
     */
    public function getStyle()
    {
        if (!$this->isPropertyAvailable("Style")) {
            return null;
        }
        return $this->getProperty("Style");
    }
    /**
     * @var string
     */
    public function setStyle($value)
    {
        $this->setProperty("Style", $value, true);
    }
    /**
     * @return string
     */
    public function getWeight()
    {
        if (!$this->isPropertyAvailable("Weight")) {
            return null;
        }
        return $this->getProperty("Weight");
    }
    /**
     * @var string
     */
    public function setWeight($value)
    {
        $this->setProperty("Weight", $value, true);
    }
}