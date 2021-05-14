<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;
use Office365\Runtime\ResourcePath;

class WorkbookWorksheet extends Entity
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
    /**
     * @return integer
     */
    public function getPosition()
    {
        if (!$this->isPropertyAvailable("Position")) {
            return null;
        }
        return $this->getProperty("Position");
    }
    /**
     * @var integer
     */
    public function setPosition($value)
    {
        $this->setProperty("Position", $value, true);
    }
    /**
     * @return string
     */
    public function getVisibility()
    {
        if (!$this->isPropertyAvailable("Visibility")) {
            return null;
        }
        return $this->getProperty("Visibility");
    }
    /**
     * @var string
     */
    public function setVisibility($value)
    {
        $this->setProperty("Visibility", $value, true);
    }
    /**
     * @return WorkbookWorksheetProtection
     */
    public function getProtection()
    {
        return $this->getProperty("Protection",
            new WorkbookWorksheetProtection($this->getContext(),
                new ResourcePath("Protection", $this->getResourcePath())));
    }
}