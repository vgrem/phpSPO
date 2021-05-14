<?php

/**
 * Modified: 2020-05-26T22:05:50+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;
use Office365\Common\Json;
use Office365\Runtime\ResourcePath;
class WorkbookChartAxis extends Entity
{
    /**
     * @return Json
     */
    public function getMajorUnit()
    {
        if (!$this->isPropertyAvailable("MajorUnit")) {
            return null;
        }
        return $this->getProperty("MajorUnit");
    }
    /**
     * @var Json
     */
    public function setMajorUnit($value)
    {
        $this->setProperty("MajorUnit", $value, true);
    }
    /**
     * @return Json
     */
    public function getMaximum()
    {
        if (!$this->isPropertyAvailable("Maximum")) {
            return null;
        }
        return $this->getProperty("Maximum");
    }
    /**
     * @var Json
     */
    public function setMaximum($value)
    {
        $this->setProperty("Maximum", $value, true);
    }
    /**
     * @return Json
     */
    public function getMinimum()
    {
        if (!$this->isPropertyAvailable("Minimum")) {
            return null;
        }
        return $this->getProperty("Minimum");
    }
    /**
     * @var Json
     */
    public function setMinimum($value)
    {
        $this->setProperty("Minimum", $value, true);
    }
    /**
     * @return Json
     */
    public function getMinorUnit()
    {
        if (!$this->isPropertyAvailable("MinorUnit")) {
            return null;
        }
        return $this->getProperty("MinorUnit");
    }
    /**
     * @var Json
     */
    public function setMinorUnit($value)
    {
        $this->setProperty("MinorUnit", $value, true);
    }
    /**
     * @return WorkbookChartAxisFormat
     */
    public function getFormat()
    {
        return $this->getProperty("Format",
            new WorkbookChartAxisFormat($this->getContext(),
                new ResourcePath("Format", $this->getResourcePath())));
    }
    /**
     * @return WorkbookChartGridlines
     */
    public function getMajorGridlines()
    {
        return $this->getProperty("MajorGridlines",
            new WorkbookChartGridlines($this->getContext(),
                new ResourcePath("MajorGridlines", $this->getResourcePath())));
    }
    /**
     * @return WorkbookChartGridlines
     */
    public function getMinorGridlines()
    {
        return $this->getProperty("MinorGridlines",
            new WorkbookChartGridlines($this->getContext(),
                new ResourcePath("MinorGridlines", $this->getResourcePath())));
    }
    /**
     * @return WorkbookChartAxisTitle
     */
    public function getTitle()
    {
        return $this->getProperty("Title",
            new WorkbookChartAxisTitle($this->getContext(), new ResourcePath("Title", $this->getResourcePath())));
    }
}