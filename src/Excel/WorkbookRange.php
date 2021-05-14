<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;
use Office365\Common\Json;
use Office365\Runtime\ResourcePath;
class WorkbookRange extends Entity
{
    /**
     * @return string
     */
    public function getAddress()
    {
        if (!$this->isPropertyAvailable("Address")) {
            return null;
        }
        return $this->getProperty("Address");
    }
    /**
     * @var string
     */
    public function setAddress($value)
    {
        $this->setProperty("Address", $value, true);
    }
    /**
     * @return string
     */
    public function getAddressLocal()
    {
        if (!$this->isPropertyAvailable("AddressLocal")) {
            return null;
        }
        return $this->getProperty("AddressLocal");
    }
    /**
     * @var string
     */
    public function setAddressLocal($value)
    {
        $this->setProperty("AddressLocal", $value, true);
    }
    /**
     * @return integer
     */
    public function getCellCount()
    {
        if (!$this->isPropertyAvailable("CellCount")) {
            return null;
        }
        return $this->getProperty("CellCount");
    }
    /**
     * @var integer
     */
    public function setCellCount($value)
    {
        $this->setProperty("CellCount", $value, true);
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
     * @return bool
     */
    public function getColumnHidden()
    {
        if (!$this->isPropertyAvailable("ColumnHidden")) {
            return null;
        }
        return $this->getProperty("ColumnHidden");
    }
    /**
     * @var bool
     */
    public function setColumnHidden($value)
    {
        $this->setProperty("ColumnHidden", $value, true);
    }
    /**
     * @return integer
     */
    public function getColumnIndex()
    {
        if (!$this->isPropertyAvailable("ColumnIndex")) {
            return null;
        }
        return $this->getProperty("ColumnIndex");
    }
    /**
     * @var integer
     */
    public function setColumnIndex($value)
    {
        $this->setProperty("ColumnIndex", $value, true);
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
     * @return bool
     */
    public function getHidden()
    {
        if (!$this->isPropertyAvailable("Hidden")) {
            return null;
        }
        return $this->getProperty("Hidden");
    }
    /**
     * @var bool
     */
    public function setHidden($value)
    {
        $this->setProperty("Hidden", $value, true);
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
     * @return bool
     */
    public function getRowHidden()
    {
        if (!$this->isPropertyAvailable("RowHidden")) {
            return null;
        }
        return $this->getProperty("RowHidden");
    }
    /**
     * @var bool
     */
    public function setRowHidden($value)
    {
        $this->setProperty("RowHidden", $value, true);
    }
    /**
     * @return integer
     */
    public function getRowIndex()
    {
        if (!$this->isPropertyAvailable("RowIndex")) {
            return null;
        }
        return $this->getProperty("RowIndex");
    }
    /**
     * @var integer
     */
    public function setRowIndex($value)
    {
        $this->setProperty("RowIndex", $value, true);
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
    /**
     * @return WorkbookRangeFormat
     */
    public function getFormat()
    {
        if (!$this->isPropertyAvailable("Format")) {
            $this->setProperty("Format", new WorkbookRangeFormat($this->getContext(), new ResourcePath("Format", $this->getResourcePath())));
        }
        return $this->getProperty("Format");
    }
    /**
     * @return WorkbookRangeSort
     */
    public function getSort()
    {
        if (!$this->isPropertyAvailable("Sort")) {
            $this->setProperty("Sort", new WorkbookRangeSort($this->getContext(), new ResourcePath("Sort", $this->getResourcePath())));
        }
        return $this->getProperty("Sort");
    }
}