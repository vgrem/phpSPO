<?php

/**
 * Generated  2025-08-18T13:04:30+00:00 16.0.26330.12013
 */
namespace Office365\SharePoint\Publishing;


use Office365\SharePoint\BaseEntity;

class HighlightsInfo extends BaseEntity
{
    /**
     * @return string
     */
    public function getHiddenHighlights()
    {
        return $this->getProperty("HiddenHighlights");
    }
    /**
     * @var string
     */
    public function setHiddenHighlights($value)
    {
        return $this->setProperty("HiddenHighlights", $value, true);
    }
    /**
     * @return string
     */
    public function getHideListEditor()
    {
        return $this->getProperty("HideListEditor");
    }
    /**
     * @var string
     */
    public function setHideListEditor($value)
    {
        return $this->setProperty("HideListEditor", $value, true);
    }
}