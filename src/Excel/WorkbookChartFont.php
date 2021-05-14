<?php

/**
 * Modified: 2020-05-25T06:42:59+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;


class WorkbookChartFont extends Entity
{
    /**
     * @return bool
     */
    public function getBold()
    {
        return $this->getProperty("Bold");
    }
    /**
     * @var bool
     */
    public function setBold($value)
    {
        $this->setProperty("Bold", $value, true);
    }
    /**
     * @return string
     */
    public function getColor()
    {
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
     * @return bool
     */
    public function getItalic()
    {
        if (!$this->isPropertyAvailable("Italic")) {
            return null;
        }
        return $this->getProperty("Italic");
    }
    /**
     * @var bool
     */
    public function setItalic($value)
    {
        $this->setProperty("Italic", $value, true);
    }
    /**
     * @return string
     */
    public function getName()
    {
        return $this->getProperty("Name");
    }
    /**
     * @var string
     */
    public function setName($value)
    {
        $this->setProperty("Name", $value, true);
    }
    /**
     * @return double
     */
    public function getSize()
    {
        return $this->getProperty("Size");
    }
    /**
     * @var double
     */
    public function setSize($value)
    {
        $this->setProperty("Size", $value, true);
    }
    /**
     * @return string
     */
    public function getUnderline()
    {
        return $this->getProperty("Underline");
    }
    /**
     * @var string
     */
    public function setUnderline($value)
    {
        $this->setProperty("Underline", $value, true);
    }
}