<?php

/**
 * Modified: 2020-05-26T22:05:50+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;
use Office365\Runtime\ResourcePath;
class WorkbookChartSeries extends Entity
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
     * @return WorkbookChartSeriesFormat
     */
    public function getFormat()
    {
        if (!$this->isPropertyAvailable("Format")) {
            $this->setProperty("Format", new WorkbookChartSeriesFormat($this->getContext(), new ResourcePath("Format", $this->getResourcePath())));
        }
        return $this->getProperty("Format");
    }
}