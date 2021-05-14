<?php

/**
 * Modified: 2020-05-26T22:04:37+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;
use Office365\Runtime\ResourcePath;
class WorkbookChartDataLabels extends Entity
{
    /**
     * @return string
     */
    public function getPosition()
    {
        if (!$this->isPropertyAvailable("Position")) {
            return null;
        }
        return $this->getProperty("Position");
    }
    /**
     * @var string
     */
    public function setPosition($value)
    {
        $this->setProperty("Position", $value, true);
    }
    /**
     * @return string
     */
    public function getSeparator()
    {
        if (!$this->isPropertyAvailable("Separator")) {
            return null;
        }
        return $this->getProperty("Separator");
    }
    /**
     * @var string
     */
    public function setSeparator($value)
    {
        $this->setProperty("Separator", $value, true);
    }
    /**
     * @return bool
     */
    public function getShowBubbleSize()
    {
        if (!$this->isPropertyAvailable("ShowBubbleSize")) {
            return null;
        }
        return $this->getProperty("ShowBubbleSize");
    }
    /**
     * @var bool
     */
    public function setShowBubbleSize($value)
    {
        $this->setProperty("ShowBubbleSize", $value, true);
    }
    /**
     * @return bool
     */
    public function getShowCategoryName()
    {
        if (!$this->isPropertyAvailable("ShowCategoryName")) {
            return null;
        }
        return $this->getProperty("ShowCategoryName");
    }
    /**
     * @var bool
     */
    public function setShowCategoryName($value)
    {
        $this->setProperty("ShowCategoryName", $value, true);
    }
    /**
     * @return bool
     */
    public function getShowLegendKey()
    {
        if (!$this->isPropertyAvailable("ShowLegendKey")) {
            return null;
        }
        return $this->getProperty("ShowLegendKey");
    }
    /**
     * @var bool
     */
    public function setShowLegendKey($value)
    {
        $this->setProperty("ShowLegendKey", $value, true);
    }
    /**
     * @return bool
     */
    public function getShowPercentage()
    {
        if (!$this->isPropertyAvailable("ShowPercentage")) {
            return null;
        }
        return $this->getProperty("ShowPercentage");
    }
    /**
     * @var bool
     */
    public function setShowPercentage($value)
    {
        $this->setProperty("ShowPercentage", $value, true);
    }
    /**
     * @return bool
     */
    public function getShowSeriesName()
    {
        if (!$this->isPropertyAvailable("ShowSeriesName")) {
            return null;
        }
        return $this->getProperty("ShowSeriesName");
    }
    /**
     * @var bool
     */
    public function setShowSeriesName($value)
    {
        $this->setProperty("ShowSeriesName", $value, true);
    }
    /**
     * @return bool
     */
    public function getShowValue()
    {
        if (!$this->isPropertyAvailable("ShowValue")) {
            return null;
        }
        return $this->getProperty("ShowValue");
    }
    /**
     * @var bool
     */
    public function setShowValue($value)
    {
        $this->setProperty("ShowValue", $value, true);
    }
    /**
     * @return WorkbookChartDataLabelFormat
     */
    public function getFormat()
    {
        if (!$this->isPropertyAvailable("Format")) {
            $this->setProperty("Format", new WorkbookChartDataLabelFormat($this->getContext(), new ResourcePath("Format", $this->getResourcePath())));
        }
        return $this->getProperty("Format");
    }
}