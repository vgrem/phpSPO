<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;
use Office365\Common\Json;

class WorkbookRangeView extends Entity
{
    /**
     * @return Json
     */
    public function getCellAddresses()
    {
        if (!$this->isPropertyAvailable("CellAddresses")) {
            return null;
        }
        return $this->getProperty("CellAddresses");
    }
    /**
     * @var Json
     */
    public function setCellAddresses($value)
    {
        $this->setProperty("CellAddresses", $value, true);
    }
    /**
     * @return integer
     */
    public function getColumnCount()
    {
        if (!$this->isPropertyAvailable("ColumnCount")) {
            return null;
        }
        return $this->getProperty("ColumnCount");
    }
    /**
     * @var integer
     */
    public function setColumnCount($value)
    {
        $this->setProperty("ColumnCount", $value, true);
    }
    /**
     * @return Json
     */
    public function getFormulas()
    {
        if (!$this->isPropertyAvailable("Formulas")) {
            return null;
        }
        return $this->getProperty("Formulas");
    }
    /**
     * @var Json
     */
    public function setFormulas($value)
    {
        $this->setProperty("Formulas", $value, true);
    }
    /**
     * @return Json
     */
    public function getFormulasLocal()
    {
        if (!$this->isPropertyAvailable("FormulasLocal")) {
            return null;
        }
        return $this->getProperty("FormulasLocal");
    }
    /**
     * @var Json
     */
    public function setFormulasLocal($value)
    {
        $this->setProperty("FormulasLocal", $value, true);
    }
    /**
     * @return Json
     */
    public function getFormulasR1C1()
    {
        if (!$this->isPropertyAvailable("FormulasR1C1")) {
            return null;
        }
        return $this->getProperty("FormulasR1C1");
    }
    /**
     * @var Json
     */
    public function setFormulasR1C1($value)
    {
        $this->setProperty("FormulasR1C1", $value, true);
    }
    /**
     * @return integer
     */
    public function getIndex()
    {
        if (!$this->isPropertyAvailable("Index")) {
            return null;
        }
        return $this->getProperty("Index");
    }
    /**
     * @var integer
     */
    public function setIndex($value)
    {
        $this->setProperty("Index", $value, true);
    }
    /**
     * @return Json
     */
    public function getNumberFormat()
    {
        if (!$this->isPropertyAvailable("NumberFormat")) {
            return null;
        }
        return $this->getProperty("NumberFormat");
    }
    /**
     * @var Json
     */
    public function setNumberFormat($value)
    {
        $this->setProperty("NumberFormat", $value, true);
    }
    /**
     * @return integer
     */
    public function getRowCount()
    {
        if (!$this->isPropertyAvailable("RowCount")) {
            return null;
        }
        return $this->getProperty("RowCount");
    }
    /**
     * @var integer
     */
    public function setRowCount($value)
    {
        $this->setProperty("RowCount", $value, true);
    }
    /**
     * @return Json
     */
    public function getText()
    {
        if (!$this->isPropertyAvailable("Text")) {
            return null;
        }
        return $this->getProperty("Text");
    }
    /**
     * @var Json
     */
    public function setText($value)
    {
        $this->setProperty("Text", $value, true);
    }
    /**
     * @return Json
     */
    public function getValueTypes()
    {
        if (!$this->isPropertyAvailable("ValueTypes")) {
            return null;
        }
        return $this->getProperty("ValueTypes");
    }
    /**
     * @var Json
     */
    public function setValueTypes($value)
    {
        $this->setProperty("ValueTypes", $value, true);
    }
    /**
     * @return Json
     */
    public function getValues()
    {
        if (!$this->isPropertyAvailable("Values")) {
            return null;
        }
        return $this->getProperty("Values");
    }
    /**
     * @var Json
     */
    public function setValues($value)
    {
        $this->setProperty("Values", $value, true);
    }
}