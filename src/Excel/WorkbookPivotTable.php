<?php

/**
 * Modified: 2020-05-26T22:05:50+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;

use Office365\Runtime\ResourcePath;
class WorkbookPivotTable extends Entity
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
     * @return WorkbookWorksheet
     */
    public function getWorksheet()
    {
        if (!$this->isPropertyAvailable("Worksheet")) {
            $this->setProperty("Worksheet", new WorkbookWorksheet($this->getContext(), new ResourcePath("Worksheet", $this->getResourcePath())));
        }
        return $this->getProperty("Worksheet");
    }
}