<?php

/**
 * Modified: 2020-05-25T06:42:59+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;
use Office365\Runtime\ResourcePath;
/**
 * Workbook is the top level object which contains related workbook objects such as worksheets, tables, ranges, etc.
 */
class Workbook extends Entity
{
    /**
     * @return WorkbookApplication
     */
    public function getApplication()
    {
        return $this->getProperty("Application",
            new WorkbookApplication($this->getContext(),
                new ResourcePath("Application", $this->getResourcePath())));
    }
    /**
     * @return WorkbookFunctions
     */
    public function getFunctions()
    {
        return $this->getProperty("Functions",
            new WorkbookFunctions($this->getContext(), new ResourcePath("Functions", $this->getResourcePath())));
    }
}