<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;
use Office365\Runtime\ResourcePath;

class WorkbookTable extends Entity
{
    /**
     * @return bool
     */
    public function getHighlightFirstColumn()
    {
        if (!$this->isPropertyAvailable("HighlightFirstColumn")) {
            return null;
        }
        return $this->getProperty("HighlightFirstColumn");
    }
    /**
     * @var bool
     */
    public function setHighlightFirstColumn($value)
    {
        $this->setProperty("HighlightFirstColumn", $value, true);
    }
    /**
     * @return bool
     */
    public function getHighlightLastColumn()
    {
        if (!$this->isPropertyAvailable("HighlightLastColumn")) {
            return null;
        }
        return $this->getProperty("HighlightLastColumn");
    }
    /**
     * @var bool
     */
    public function setHighlightLastColumn($value)
    {
        $this->setProperty("HighlightLastColumn", $value, true);
    }
    /**
     * @return string
     */
    public function getLegacyId()
    {
        if (!$this->isPropertyAvailable("LegacyId")) {
            return null;
        }
        return $this->getProperty("LegacyId");
    }
    /**
     * @var string
     */
    public function setLegacyId($value)
    {
        $this->setProperty("LegacyId", $value, true);
    }
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
     * @return bool
     */
    public function getShowBandedColumns()
    {
        if (!$this->isPropertyAvailable("ShowBandedColumns")) {
            return null;
        }
        return $this->getProperty("ShowBandedColumns");
    }
    /**
     * @var bool
     */
    public function setShowBandedColumns($value)
    {
        $this->setProperty("ShowBandedColumns", $value, true);
    }
    /**
     * @return bool
     */
    public function getShowBandedRows()
    {
        if (!$this->isPropertyAvailable("ShowBandedRows")) {
            return null;
        }
        return $this->getProperty("ShowBandedRows");
    }
    /**
     * @var bool
     */
    public function setShowBandedRows($value)
    {
        $this->setProperty("ShowBandedRows", $value, true);
    }
    /**
     * @return bool
     */
    public function getShowFilterButton()
    {
        if (!$this->isPropertyAvailable("ShowFilterButton")) {
            return null;
        }
        return $this->getProperty("ShowFilterButton");
    }
    /**
     * @var bool
     */
    public function setShowFilterButton($value)
    {
        $this->setProperty("ShowFilterButton", $value, true);
    }
    /**
     * @return bool
     */
    public function getShowHeaders()
    {
        if (!$this->isPropertyAvailable("ShowHeaders")) {
            return null;
        }
        return $this->getProperty("ShowHeaders");
    }
    /**
     * @var bool
     */
    public function setShowHeaders($value)
    {
        $this->setProperty("ShowHeaders", $value, true);
    }
    /**
     * @return bool
     */
    public function getShowTotals()
    {
        if (!$this->isPropertyAvailable("ShowTotals")) {
            return null;
        }
        return $this->getProperty("ShowTotals");
    }
    /**
     * @var bool
     */
    public function setShowTotals($value)
    {
        $this->setProperty("ShowTotals", $value, true);
    }
    /**
     * @return string
     */
    public function getStyle()
    {
        if (!$this->isPropertyAvailable("Style")) {
            return null;
        }
        return $this->getProperty("Style");
    }
    /**
     * @var string
     */
    public function setStyle($value)
    {
        $this->setProperty("Style", $value, true);
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
     * @return WorkbookTableSort
     */
    public function getSort()
    {
        if (!$this->isPropertyAvailable("Sort")) {
            $this->setProperty("Sort", new WorkbookTableSort($this->getContext(), new ResourcePath("Sort", $this->getResourcePath())));
        }
        return $this->getProperty("Sort");
    }
}