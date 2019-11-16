<?php

/**
 * Updated By PHP Office365 Generator 2019-11-16T20:01:10+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

/**
 * Specifies 
 * a field 
 * (2) that contains number values. To set properties, call the Update 
 * method (section 3.2.5.53.2.1.5).The NoCrawl and SchemaXmlWithResourceTokens properties are 
 * not included in the default scalar property set 
 * for this type.
 */
class FieldNumber extends Field
{
    /**
     * Gets the 
     * number of decimal places to be used when displaying the field.
     * @return integer
     */
    public function getDisplayFormat()
    {
        if (!$this->isPropertyAvailable("DisplayFormat")) {
            return null;
        }
        return $this->getProperty("DisplayFormat");
    }
    /**
     * Gets the 
     * number of decimal places to be used when displaying the field.
     * @var integer
     */
    public function setDisplayFormat($value)
    {
        $this->setProperty("DisplayFormat", $value, true);
    }
    /**
     * Specifies 
     * the maximum allowed value for the field (2).
     * @return double
     */
    public function getMaximumValue()
    {
        if (!$this->isPropertyAvailable("MaximumValue")) {
            return null;
        }
        return $this->getProperty("MaximumValue");
    }
    /**
     * Specifies 
     * the maximum allowed value for the field (2).
     * @var double
     */
    public function setMaximumValue($value)
    {
        $this->setProperty("MaximumValue", $value, true);
    }
    /**
     * Specifies 
     * the minimum allowed value for the field (2).
     * @return double
     */
    public function getMinimumValue()
    {
        if (!$this->isPropertyAvailable("MinimumValue")) {
            return null;
        }
        return $this->getProperty("MinimumValue");
    }
    /**
     * Specifies 
     * the minimum allowed value for the field (2).
     * @var double
     */
    public function setMinimumValue($value)
    {
        $this->setProperty("MinimumValue", $value, true);
    }
    /**
     * Gets or 
     * sets a Boolean value that specifies whether to render the field as a 
     * percentage.
     * @return bool
     */
    public function getShowAsPercentage()
    {
        if (!$this->isPropertyAvailable("ShowAsPercentage")) {
            return null;
        }
        return $this->getProperty("ShowAsPercentage");
    }
    /**
     * Gets or 
     * sets a Boolean value that specifies whether to render the field as a 
     * percentage.
     * @var bool
     */
    public function setShowAsPercentage($value)
    {
        $this->setProperty("ShowAsPercentage", $value, true);
    }
}