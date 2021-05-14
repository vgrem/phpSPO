<?php

/**
 * Modified: 2020-05-26T22:05:50+00:00 
 */
namespace Office365\Excel;

use Office365\Runtime\ClientObject;
use Office365\Runtime\ResourcePath;
class WorkbookChartSeriesFormat extends ClientObject
{
    /**
     * @return WorkbookChartFill
     */
    public function getFill()
    {
        if (!$this->isPropertyAvailable("Fill")) {
            $this->setProperty("Fill", new WorkbookChartFill($this->getContext(), new ResourcePath("Fill", $this->getResourcePath())));
        }
        return $this->getProperty("Fill");
    }
    /**
     * @return WorkbookChartLineFormat
     */
    public function getLine()
    {
        if (!$this->isPropertyAvailable("Line")) {
            $this->setProperty("Line", new WorkbookChartLineFormat($this->getContext(), new ResourcePath("Line", $this->getResourcePath())));
        }
        return $this->getProperty("Line");
    }
}