<?php

/**
 * Modified: 2020-05-26T22:05:50+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;

class WorkbookFormatProtection extends Entity
{
    /**
     * @return bool
     */
    public function getFormulaHidden()
    {
        if (!$this->isPropertyAvailable("FormulaHidden")) {
            return null;
        }
        return $this->getProperty("FormulaHidden");
    }
    /**
     * @var bool
     */
    public function setFormulaHidden($value)
    {
        $this->setProperty("FormulaHidden", $value, true);
    }
    /**
     * @return bool
     */
    public function getLocked()
    {
        if (!$this->isPropertyAvailable("Locked")) {
            return null;
        }
        return $this->getProperty("Locked");
    }
    /**
     * @var bool
     */
    public function setLocked($value)
    {
        $this->setProperty("Locked", $value, true);
    }
}