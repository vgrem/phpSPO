<?php

/**
 * Generated 2021-08-22T15:28:03+00:00 16.0.21611.12002
 */
namespace Office365\SharePoint\Publishing;

use Office365\SharePoint\BaseEntity;
class FeedVideoPage extends BaseEntity
{
    /**
     * @return integer
     */
    public function getVideoDuration()
    {
        return $this->getProperty("VideoDuration");
    }
    /**
     * @param $value
     * @return self
     */
    public function setVideoDuration($value)
    {
        return $this->setProperty("VideoDuration", $value, true);
    }
    /**
     * @return string
     */
    public function getModernAudienceTargetUserField()
    {
        return $this->getProperty("ModernAudienceTargetUserField");
    }
    /**
     * @var string
     */
    public function setModernAudienceTargetUserField($value)
    {
        return $this->setProperty("ModernAudienceTargetUserField", $value, true);
    }
}