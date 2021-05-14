<?php

/**
 * Modified: 2020-05-26T22:04:37+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;
use Office365\Runtime\ResourcePath;

class WorkbookChartAreaFormat extends Entity
{
    /**
     * @return WorkbookChartFill
     */
    public function getFill()
    {
        return $this->getProperty("Fill",
            new WorkbookChartFill($this->getContext(), new ResourcePath("Fill", $this->getResourcePath())));
    }
    /**
     * @return WorkbookChartFont
     */
    public function getFont()
    {
        return $this->getProperty("Font",
            new WorkbookChartFont($this->getContext(), new ResourcePath("Font", $this->getResourcePath())));
    }
}