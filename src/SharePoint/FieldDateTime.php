<?php

/**
 * Updated By PHP Office365 Generator 2019-11-16T20:01:10+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

/**
 * Specifies 
 * a field 
 * (2) that contains date and time values. To set properties, call the Update 
 * method (section 3.2.5.44.2.1.5).The NoCrawl and SchemaXmlWithResourceTokens properties are 
 * not included in the default scalar property set 
 * for this type.
 */
class FieldDateTime extends Field
{
    /**
     * Specifies 
     * the calendar 
     * type of the field (2).It MUST be 
     * None if the field (2) is in an external list.
     * @return integer
     */
    public function getDateTimeCalendarType()
    {
        if (!$this->isPropertyAvailable("DateTimeCalendarType")) {
            return null;
        }
        return $this->getProperty("DateTimeCalendarType");
    }
    /**
     * Specifies 
     * the calendar 
     * type of the field (2).It MUST be 
     * None if the field (2) is in an external list.
     * @var integer
     */
    public function setDateTimeCalendarType($value)
    {
        $this->setProperty("DateTimeCalendarType", $value, true);
    }
    /**
     * Specifies 
     * the type of date and time format that is used in the field (2).
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
     * Specifies 
     * the type of date and time format that is used in the field (2).
     * @var integer
     */
    public function setDisplayFormat($value)
    {
        $this->setProperty("DisplayFormat", $value, true);
    }
    /**
     * Gets or 
     * sets the type of friendly display format that is used in the field.<16>
     * @return integer
     */
    public function getFriendlyDisplayFormat()
    {
        if (!$this->isPropertyAvailable("FriendlyDisplayFormat")) {
            return null;
        }
        return $this->getProperty("FriendlyDisplayFormat");
    }
    /**
     * Gets or 
     * sets the type of friendly display format that is used in the field.<16>
     * @var integer
     */
    public function setFriendlyDisplayFormat($value)
    {
        $this->setProperty("FriendlyDisplayFormat", $value, true);
    }
}