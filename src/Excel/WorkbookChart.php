<?php

/**
 * Modified: 2020-05-26T22:03:10+00:00 
 */
namespace Office365\Excel;


use Office365\Entity;
use Office365\Runtime\ResourcePath;

class WorkbookChart extends Entity
{
    /**
     * @return double
     */
    public function getHeight()
    {
        if (!$this->isPropertyAvailable("Height")) {
            return null;
        }
        return $this->getProperty("Height");
    }
    /**
     * @var double
     */
    public function setHeight($value)
    {
        $this->setProperty("Height", $value, true);
    }
    /**
     * @return double
     */
    public function getLeft()
    {
        if (!$this->isPropertyAvailable("Left")) {
            return null;
        }
        return $this->getProperty("Left");
    }
    /**
     * @var double
     */
    public function setLeft($value)
    {
        $this->setProperty("Left", $value, true);
    }
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
     * @return double
     */
    public function getTop()
    {
        if (!$this->isPropertyAvailable("Top")) {
            return null;
        }
        return $this->getProperty("Top");
    }
    /**
     * @var double
     */
    public function setTop($value)
    {
        $this->setProperty("Top", $value, true);
    }
    /**
     * @return double
     */
    public function getWidth()
    {
        if (!$this->isPropertyAvailable("Width")) {
            return null;
        }
        return $this->getProperty("Width");
    }
    /**
     * @var double
     */
    public function setWidth($value)
    {
        $this->setProperty("Width", $value, true);
    }
    /**
     * @return WorkbookWorksheet
     */
    public function getWorksheet()
    {
        if (!$this->isPropertyAvailable("Worksheet")) {
            $this->setProperty("Worksheet", new WorkbookWorksheet($this->getContext(),
                new ResourcePath("Worksheet", $this->getResourcePath())));
        }
        return $this->getProperty("Worksheet");
    }
    /**
     * @return WorkbookChartAxes
     */
    public function getAxes()
    {
        if (!$this->isPropertyAvailable("Axes")) {
            $this->setProperty("Axes", new WorkbookChartAxes($this->getContext(),
                new ResourcePath("Axes", $this->getResourcePath())));
        }
        return $this->getProperty("Axes");
    }
    /**
     * @return WorkbookChartDataLabels
     */
    public function getDataLabels()
    {
        if (!$this->isPropertyAvailable("DataLabels")) {
            $this->setProperty("DataLabels",
                new WorkbookChartDataLabels($this->getContext(), new ResourcePath("DataLabels", $this->getResourcePath())));
        }
        return $this->getProperty("DataLabels");
    }
    /**
     * @return WorkbookChartAreaFormat
     */
    public function getFormat()
    {
        if (!$this->isPropertyAvailable("Format")) {
            $this->setProperty("Format",
                new WorkbookChartAreaFormat($this->getContext(), new ResourcePath("Format", $this->getResourcePath())));
        }
        return $this->getProperty("Format");
    }
    /**
     * @return WorkbookChartLegend
     */
    public function getLegend()
    {
        if (!$this->isPropertyAvailable("Legend")) {
            $this->setProperty("Legend", new WorkbookChartLegend($this->getContext(), new ResourcePath("Legend", $this->getResourcePath())));
        }
        return $this->getProperty("Legend");
    }
    /**
     * @return WorkbookChartTitle
     */
    public function getTitle()
    {
        if (!$this->isPropertyAvailable("Title")) {
            $this->setProperty("Title", new WorkbookChartTitle($this->getContext(), new ResourcePath("Title", $this->getResourcePath())));
        }
        return $this->getProperty("Title");
    }
}