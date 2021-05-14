<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;

/**
 * Represents the Excel application that manages the workbook.
 */
class WorkbookApplication extends Entity
{
    /**
     * Returns the calculation mode used in the workbook. Possible values are: `Automatic`, `AutomaticExceptTables`, `Manual`.
     * @return string
     */
    public function getCalculationMode()
    {
        if (!$this->isPropertyAvailable("CalculationMode")) {
            return null;
        }
        return $this->getProperty("CalculationMode");
    }
    /**
     * Returns the calculation mode used in the workbook. Possible values are: `Automatic`, `AutomaticExceptTables`, `Manual`.
     * @var string
     */
    public function setCalculationMode($value)
    {
        $this->setProperty("CalculationMode", $value, true);
    }
}