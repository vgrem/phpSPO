<?php

/**
 * Modified: 2020-05-26T22:05:50+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;
use Office365\Common\Json;
use Office365\Runtime\ResourcePath;
class WorkbookChartPoint extends Entity
{
    /**
     * @return Json
     */
    public function getValue()
    {
        if (!$this->isPropertyAvailable("Value")) {
            return null;
        }
        return $this->getProperty("Value");
    }
    /**
     * @var Json
     */
    public function setValue($value)
    {
        $this->setProperty("Value", $value, true);
    }
    /**
     * @return WorkbookChartPointFormat
     */
    public function getFormat()
    {
        if (!$this->isPropertyAvailable("Format")) {
            $this->setProperty("Format", new WorkbookChartPointFormat($this->getContext(), new ResourcePath("Format", $this->getResourcePath())));
        }
        return $this->getProperty("Format");
    }
}