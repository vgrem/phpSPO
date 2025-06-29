<?php

/**
 * Generated  2025-06-14T08:50:37+00:00 16.0.26121.12017
 */
namespace Office365\SharePoint\Publishing;

use Office365\Runtime\ClientObject;
class SitePage extends ClientObject
{
    /**
     * @return string
     */
    public function getAlternativeUrlMap()
    {
        return $this->getProperty("AlternativeUrlMap");
    }
    /**
     * @var string
     */
    public function setAlternativeUrlMap($value)
    {
        $this->setProperty("AlternativeUrlMap", $value, true);
    }
    /**
     * @return string
     */
    public function getCanvasContent1()
    {
        return $this->getProperty("CanvasContent1");
    }
    /**
     * @var string
     */
    public function setCanvasContent1($value)
    {
        $this->setProperty("CanvasContent1", $value, true);
    }
    /**
     * @return string
     */
    public function getCanvasJson1()
    {
        return $this->getProperty("CanvasJson1");
    }
    /**
     * @var string
     */
    public function setCanvasJson1($value)
    {
        $this->setProperty("CanvasJson1", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsLikedByCurrentUser()
    {
        return $this->getProperty("IsLikedByCurrentUser");
    }
    /**
     * @var bool
     */
    public function setIsLikedByCurrentUser($value)
    {
        $this->setProperty("IsLikedByCurrentUser", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsTemplate()
    {
        return $this->getProperty("IsTemplate");
    }
    /**
     * @var bool
     */
    public function setIsTemplate($value)
    {
        $this->setProperty("IsTemplate", $value, true);
    }
    /**
     * @return string
     */
    public function getLayoutWebpartsContent()
    {
        return $this->getProperty("LayoutWebpartsContent");
    }
    /**
     * @var string
     */
    public function setLayoutWebpartsContent($value)
    {
        $this->setProperty("LayoutWebpartsContent", $value, true);
    }
    /**
     * @return string
     */
    public function getName()
    {
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
     * @return string
     */
    public function getSitePageFlags()
    {
        return $this->getProperty("SitePageFlags");
    }
    /**
     * @var string
     */
    public function setSitePageFlags($value)
    {
        $this->setProperty("SitePageFlags", $value, true);
    }
    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->getProperty("Language");
    }
    /**
     * @var string
     */
    public function setLanguage($value)
    {
        return $this->setProperty("Language", $value, true);
    }
    /**
     * @return bool
     */
    public function getCheckIn()
    {
        return $this->getProperty("CheckIn");
    }
    /**
     * @var bool
     */
    public function setCheckIn($value)
    {
        return $this->setProperty("CheckIn", $value, true);
    }
    /**
     * @return integer
     */
    public function getCreationMode()
    {
        return $this->getProperty("CreationMode");
    }
    /**
     * @var integer
     */
    public function setCreationMode($value)
    {
        return $this->setProperty("CreationMode", $value, true);
    }
    /**
     * @return string
     */
    public function getTranspileContent()
    {
        return $this->getProperty("TranspileContent");
    }
    /**
     * @var string
     */
    public function setTranspileContent($value)
    {
        return $this->setProperty("TranspileContent", $value, true);
    }
    /**
     * @return SitePageAuthoringMetadata
     */
    public function getAuthoringMetadata()
    {
        return $this->getProperty("AuthoringMetadata");
    }
    /**
     * @var SitePageAuthoringMetadata
     */
    public function setAuthoringMetadata($value)
    {
        return $this->setProperty("AuthoringMetadata", $value, true);
    }
    /**
     * @return SitePageBoostProperties
     */
    public function getBoostProperties()
    {
        return $this->getProperty("BoostProperties");
    }
    /**
     * @var SitePageBoostProperties
     */
    public function setBoostProperties($value)
    {
        return $this->setProperty("BoostProperties", $value, true);
    }
    /**
     * @return string
     */
    public function getPublicationMetadata()
    {
        return $this->getProperty("PublicationMetadata");
    }
    /**
     * @var string
     */
    public function setPublicationMetadata($value)
    {
        return $this->setProperty("PublicationMetadata", $value, true);
    }
    /**
     * @return string
     */
    public function getPublicationRecipients()
    {
        return $this->getProperty("PublicationRecipients");
    }
    /**
     * @var string
     */
    public function setPublicationRecipients($value)
    {
        return $this->setProperty("PublicationRecipients", $value, true);
    }
    /**
     * @return string
     */
    public function getCampaignMetadata()
    {
        return $this->getProperty("CampaignMetadata");
    }
    /**
     * @var string
     */
    public function setCampaignMetadata($value)
    {
        return $this->setProperty("CampaignMetadata", $value, true);
    }
    /**
     * @return string
     */
    public function getSourceDynamicSectionId()
    {
        return $this->getProperty("SourceDynamicSectionId");
    }
    /**
     * @var string
     */
    public function setSourceDynamicSectionId($value)
    {
        return $this->setProperty("SourceDynamicSectionId", $value, true);
    }
}