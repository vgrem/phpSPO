<?php

/**
 * Modified: 2020-05-26T22:05:50+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;
use Office365\Runtime\ResourcePath;
class WorkbookChartAxisTitleFormat extends Entity
{
    /**
     * @return WorkbookChartFont
     */
    public function getFont()
    {
        if (!$this->isPropertyAvailable("Font")) {
            $this->setProperty("Font", new WorkbookChartFont($this->getContext(), new ResourcePath("Font", $this->getResourcePath())));
        }
        return $this->getProperty("Font");
    }
}