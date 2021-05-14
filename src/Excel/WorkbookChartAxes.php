<?php

/**
 * Modified: 2020-05-26T22:04:06+00:00 
 */
namespace Office365\Excel;

use Office365\Runtime\ClientObject;
use Office365\Runtime\ResourcePath;
class WorkbookChartAxes extends ClientObject
{
    /**
     * @return WorkbookChartAxis
     */
    public function getCategoryAxis()
    {
        if (!$this->isPropertyAvailable("CategoryAxis")) {
            $this->setProperty("CategoryAxis", new WorkbookChartAxis($this->getContext(), new ResourcePath("CategoryAxis", $this->getResourcePath())));
        }
        return $this->getProperty("CategoryAxis");
    }
    /**
     * @return WorkbookChartAxis
     */
    public function getSeriesAxis()
    {
        if (!$this->isPropertyAvailable("SeriesAxis")) {
            $this->setProperty("SeriesAxis", new WorkbookChartAxis($this->getContext(), new ResourcePath("SeriesAxis", $this->getResourcePath())));
        }
        return $this->getProperty("SeriesAxis");
    }
    /**
     * @return WorkbookChartAxis
     */
    public function getValueAxis()
    {
        if (!$this->isPropertyAvailable("ValueAxis")) {
            $this->setProperty("ValueAxis", new WorkbookChartAxis($this->getContext(), new ResourcePath("ValueAxis", $this->getResourcePath())));
        }
        return $this->getProperty("ValueAxis");
    }
}