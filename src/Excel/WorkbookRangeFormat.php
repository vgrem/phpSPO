<?php

/**
 * Updated: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Excel;

use Office365\Entity;
use Office365\Runtime\ResourcePath;
class WorkbookRangeFormat extends Entity
{
    /**
     * @return double
     */
    public function getColumnWidth()
    {
        if (!$this->isPropertyAvailable("ColumnWidth")) {
            return null;
        }
        return $this->getProperty("ColumnWidth");
    }
    /**
     * @var double
     */
    public function setColumnWidth($value)
    {
        $this->setProperty("ColumnWidth", $value, true);
    }
    /**
     * @return string
     */
    public function getHorizontalAlignment()
    {
        if (!$this->isPropertyAvailable("HorizontalAlignment")) {
            return null;
        }
        return $this->getProperty("HorizontalAlignment");
    }
    /**
     * @var string
     */
    public function setHorizontalAlignment($value)
    {
        $this->setProperty("HorizontalAlignment", $value, true);
    }
    /**
     * @return double
     */
    public function getRowHeight()
    {
        if (!$this->isPropertyAvailable("RowHeight")) {
            return null;
        }
        return $this->getProperty("RowHeight");
    }
    /**
     * @var double
     */
    public function setRowHeight($value)
    {
        $this->setProperty("RowHeight", $value, true);
    }
    /**
     * @return string
     */
    public function getVerticalAlignment()
    {
        if (!$this->isPropertyAvailable("VerticalAlignment")) {
            return null;
        }
        return $this->getProperty("VerticalAlignment");
    }
    /**
     * @var string
     */
    public function setVerticalAlignment($value)
    {
        $this->setProperty("VerticalAlignment", $value, true);
    }
    /**
     * @return bool
     */
    public function getWrapText()
    {
        if (!$this->isPropertyAvailable("WrapText")) {
            return null;
        }
        return $this->getProperty("WrapText");
    }
    /**
     * @var bool
     */
    public function setWrapText($value)
    {
        $this->setProperty("WrapText", $value, true);
    }
    /**
     * @return WorkbookFormatProtection
     */
    public function getProtection()
    {
        if (!$this->isPropertyAvailable("Protection")) {
            $this->setProperty("Protection", new WorkbookFormatProtection($this->getContext(), new ResourcePath("Protection", $this->getResourcePath())));
        }
        return $this->getProperty("Protection");
    }
    /**
     * @return WorkbookRangeFill
     */
    public function getFill()
    {
        if (!$this->isPropertyAvailable("Fill")) {
            $this->setProperty("Fill", new WorkbookRangeFill($this->getContext(), new ResourcePath("Fill", $this->getResourcePath())));
        }
        return $this->getProperty("Fill");
    }
    /**
     * @return WorkbookRangeFont
     */
    public function getFont()
    {
        if (!$this->isPropertyAvailable("Font")) {
            $this->setProperty("Font", new WorkbookRangeFont($this->getContext(), new ResourcePath("Font", $this->getResourcePath())));
        }
        return $this->getProperty("Font");
    }
}