<?php

/**
 * Modified: 2020-05-26T22:05:50+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;
use Office365\Runtime\ResourcePath;
class WorkbookChartLegend extends Entity
{
    /**
     * @return bool
     */
    public function getOverlay()
    {
        if (!$this->isPropertyAvailable("Overlay")) {
            return null;
        }
        return $this->getProperty("Overlay");
    }
    /**
     * @var bool
     */
    public function setOverlay($value)
    {
        $this->setProperty("Overlay", $value, true);
    }
    /**
     * @return string
     */
    public function getPosition()
    {
        if (!$this->isPropertyAvailable("Position")) {
            return null;
        }
        return $this->getProperty("Position");
    }
    /**
     * @var string
     */
    public function setPosition($value)
    {
        $this->setProperty("Position", $value, true);
    }
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
     * @return WorkbookChartLegendFormat
     */
    public function getFormat()
    {
        if (!$this->isPropertyAvailable("Format")) {
            $this->setProperty("Format", new WorkbookChartLegendFormat($this->getContext(), new ResourcePath("Format", $this->getResourcePath())));
        }
        return $this->getProperty("Format");
    }
}