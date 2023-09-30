<?php

/**
 * Generated  2023-09-30T09:13:50+00:00 16.0.24106.12014
 */
namespace Office365\SharePoint\Publishing;

use Office365\SharePoint\BaseEntity;
class CampaignPublication extends BaseEntity
{
    /**
     * @return string
     */
    public function getEmailEndpoint()
    {
        return $this->getProperty("EmailEndpoint");
    }
    /**
     * @var string
     */
    public function setEmailEndpoint($value)
    {
        return $this->setProperty("EmailEndpoint", $value, true);
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
     * @return integer
     */
    public function getPublicationStatus()
    {
        return $this->getProperty("PublicationStatus");
    }
    /**
     * @var integer
     */
    public function setPublicationStatus($value)
    {
        return $this->setProperty("PublicationStatus", $value, true);
    }
    /**
     * @return string
     */
    public function getSharePointEndpoint()
    {
        return $this->getProperty("SharePointEndpoint");
    }
    /**
     * @var string
     */
    public function setSharePointEndpoint($value)
    {
        return $this->setProperty("SharePointEndpoint", $value, true);
    }
    /**
     * @return string
     */
    public function getYammerEndpoint()
    {
        return $this->getProperty("YammerEndpoint");
    }
    /**
     * @var string
     */
    public function setYammerEndpoint($value)
    {
        return $this->setProperty("YammerEndpoint", $value, true);
    }
    /**
     * @return string
     */
    public function getTeamsEndpoint()
    {
        return $this->getProperty("TeamsEndpoint");
    }
    /**
     * @var string
     */
    public function setTeamsEndpoint($value)
    {
        return $this->setProperty("TeamsEndpoint", $value, true);
    }
}