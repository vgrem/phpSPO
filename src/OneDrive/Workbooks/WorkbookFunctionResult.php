<?php

/**
 * Modified: 2020-05-26T22:05:50+00:00 
 */
namespace Office365\OneDrive\Workbooks;

use Office365\Entity;


class WorkbookFunctionResult extends Entity
{
    /**
     * @return string
     */
    public function getError()
    {
        if (!$this->isPropertyAvailable("Error")) {
            return null;
        }
        return $this->getProperty("Error");
    }
    /**
     * @var string
     */
    public function setError($value)
    {
        $this->setProperty("Error", $value, true);
    }
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
}