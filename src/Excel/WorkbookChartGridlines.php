<?php

/**
 * Generated by phpSPO model generator 2020-05-26T22:05:50+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;
use Office365\Runtime\ResourcePath;
class WorkbookChartGridlines extends Entity
{
    /**
     * @return bool
     */
    public function getVisible()
    {
        if (!$this->isPropertyAvailable("Visible")) {
            return null;
        }
        return $this->getProperty("Visible");
    }
    /**
     * @var bool
     */
    public function setVisible($value)
    {
        $this->setProperty("Visible", $value, true);
    }
    /**
     * @return WorkbookChartGridlinesFormat
     */
    public function getFormat()
    {
        if (!$this->isPropertyAvailable("Format")) {
            $this->setProperty("Format", new WorkbookChartGridlinesFormat($this->getContext(), new ResourcePath("Format", $this->getResourcePath())));
        }
        return $this->getProperty("Format");
    }
}